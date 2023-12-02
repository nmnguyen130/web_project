// Get references to the map data
const mapInfo = simplemaps_countrymap_mapinfo;
const mapData = simplemaps_countrymap_mapdata;

const viewWidth = mapInfo.initial_view.x2;
const viewHeight = mapInfo.initial_view.y2;

const aspectRatio = viewHeight / viewWidth;

const mapContainer = $("#map");
const windowWidth = mapContainer.width();
const windowHeight = window.innerHeight;

var zoomScale = 1;

const paths = [];
let selectedPaths = [];

// Set the Raphael paper for drawing the map
var paper = Raphael("map", windowWidth, windowHeight);
paper.setViewBox(
  mapInfo.initial_view.x / 2,
  mapInfo.initial_view.y,
  mapInfo.initial_view.x2,
  mapInfo.initial_view.y2,
  true
);

// Show infobox when hover on the province
const infoBox = $("#info-box");

function showInfo(x, y, regionName) {
  infoBox.css({ left: x + "px", top: y + "px" });
  infoBox.html(regionName);
  infoBox.css("display", "block");
}

// Function to hide the info box when not hovering
function hideInfo() {
  infoBox.css("display", "none");
}

// Function to create and style a path element
function createPath(pathData, pathKey) {
  const path = paper.path(pathData).attr({
    fill: mapData.main_settings.state_color,
    "stroke-width": mapData.main_settings.border_size,
    stroke: mapData.main_settings.border_color,
  });

  path.hover(
    () => {
      if (!selectedPaths.includes(path)) {
        path.animate({ fill: mapData.main_settings.state_hover_color }, 200);
      }
    },
    () => {
      if (!selectedPaths.includes(path)) {
        path.animate({ fill: mapData.main_settings.state_color }, 200);
      }
      hideInfo();
    }
  );

  path.mousemove((e) => {
    showInfo(e.clientX + 20, e.clientY - 15, mapInfo.names[pathKey]);
  });

  path.mouseout(() => {
    if (!selectedPaths.includes(path)) {
      path.animate({ fill: mapData.main_settings.state_color }, 200);
    }
    hideInfo();
  });

  path.click(() => {
    resetSelectedPath();

    handlePathSelect(path);

    var provinceName = mapInfo.names[pathKey];
    sendData(provinceName);

    const bbox = path.getBBox();
    zoomToRegion(bbox.x, bbox.y, bbox.width, bbox.height);
  });

  path.data("key", pathKey);

  return path;
}

function zoomToRegion(x, y, width, height) {
  var centerX = x + width / 2;
  var centerY = y + height / 2;

  if (width >= height || width > height / aspectRatio) {
    height = width * aspectRatio;
  } else if (width < height) {
    width = height / aspectRatio;
  }

  var rectX = centerX - width / 2;
  var rectY = centerY - height / 2;

  animateViewBox(paper, rectX, rectY, width, height, 500);
}

function zoomToCenter(scaleFactor) {
  const currentViewBox = paper._viewBox;

  const centerX = currentViewBox[0] + currentViewBox[2] / 2;
  const centerY = currentViewBox[1] + currentViewBox[3] / 2;

  const newWidth = currentViewBox[2] * scaleFactor;
  const newHeight = currentViewBox[3] * scaleFactor;

  const x = centerX - newWidth / 2;
  const y = centerY - newHeight / 2;

  zoomScale = viewHeight / newHeight;

  if (zoomScale >= 0.9) {
    paper.setViewBox(x, y, newWidth, newHeight, true);
    dragSpeed = newHeight / windowHeight;
  }
}

// Animation function
function animateViewBox(paper, x, y, width, height, duration) {
  var currentViewBox = paper._viewBox;
  var targetViewBox = [x, y, width, height];
  var startTime = new Date().getTime();

  function updateViewBox() {
    var currentTime = new Date().getTime();
    var elapsedTime = currentTime - startTime;

    if (elapsedTime < duration) {
      var t = elapsedTime / duration;
      var newViewBox = currentViewBox.map(function (current, index) {
        return current + (targetViewBox[index] - current) * t;
      });

      paper.setViewBox(
        newViewBox[0],
        newViewBox[1],
        newViewBox[2],
        newViewBox[3],
        true
      );

      requestAnimationFrame(updateViewBox);
    } else {
      paper.setViewBox(x, y, width, height, true);
      dragSpeed = height / windowHeight;
    }
  }

  updateViewBox();
}

// Mouse Event for map
let isDragging = false;
let startMouseX, startMouseY, startViewBox;
let dragSpeed = 4;

function setupEventListeners() {
  paper.canvas.addEventListener("wheel", handleMouseWheel);
  paper.canvas.addEventListener("mousedown", handleMouseDown);
  paper.canvas.addEventListener("mousemove", handleMouseMove);
  paper.canvas.addEventListener("mouseup", handleMouseUp);
}

function handleMouseWheel(e) {
  e.preventDefault();
  const scaleFactor = e.deltaY > 0 ? 1.04 : 0.96;

  zoomToCenter(scaleFactor);
}

function handleMouseDown(e) {
  isDragging = true;
  startMouseX = e.clientX;
  startMouseY = e.clientY;
  startViewBox = paper._viewBox;
  paper.canvas.style.cursor = "grabbing";
}

function handleMouseMove(e) {
  if (isDragging) {
    const deltaX = (e.clientX - startMouseX) * dragSpeed;
    const deltaY = (e.clientY - startMouseY) * dragSpeed;
    const newX = startViewBox[0] - deltaX;
    const newY = startViewBox[1] - deltaY;
    paper.setViewBox(newX, newY, startViewBox[2], startViewBox[3], true);
  }
}

function handleMouseUp(e) {
  isDragging = false;
  paper.canvas.style.cursor = "default";
}

// Function to draw paths
function initializeMap() {
  for (const pathKey in mapInfo.paths) {
    const pathData = mapInfo.paths[pathKey];
    const path = createPath(pathData, pathKey);
    paths.push(path);
  }
}

// Resize the svg map
function updateSVGSize() {
  const newWindowWidth = mapContainer.width();

  paper.setSize(newWindowWidth, windowHeight);
}

window.addEventListener("resize", updateSVGSize);

initializeMap();
setupEventListeners();
updateSVGSize();

// Show province on map when click in a province list
function zoomToProvince(provinceName) {
  resetSelectedPath();

  const path = findPathByProvinceName(provinceName);

  if (path) {
    handlePathSelect(path);
    const bbox = path.getBBox();
    zoomToRegion(bbox.x, bbox.y, bbox.width, bbox.height);
  }
}

// Find all province by name
function findAllProvinceBy(provinces) {
  resetSelectedPath();

  provinces.forEach((province) => {
    const provinceName = province.name;
    const path = findPathByProvinceName(provinceName);

    if (path) {
      handlePathSelect(path);
    }
  });

  zoomToRegion(
    mapInfo.initial_view.x / 2,
    mapInfo.initial_view.y,
    mapInfo.initial_view.x2,
    mapInfo.initial_view.y2
  );
}

// Util Function
function resetSelectedPath() {
  selectedPaths.forEach((selectedPath) => {
    selectedPath.animate({ fill: mapData.main_settings.state_color }, 200);
  });
  selectedPaths = [];
}

function findPathByProvinceName(provinceName) {
  return paths.find((path) => mapInfo.names[path.data("key")] === provinceName);
}

function handlePathSelect(path) {
  path.animate({ fill: mapData.main_settings.state_hover_color }, 200);
  selectedPaths.push(path);
}
