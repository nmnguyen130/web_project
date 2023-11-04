<?php

class Test
{
    use Controller;

    public function index()
    {
        $province = new Province();
        $name = "Đà Nẵng";

        $result = $province->getAnimalOfProvince($name);

        show($result);

        $this->view('test');
    }
}
