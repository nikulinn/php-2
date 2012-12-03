<?php

abstract class Shape

{
    protected $a;
    protected $r;
    protected $h;

    function __construct($a, $r, $h)
    {
        $this->a = $a;
        $this->h = $h;
        $this->r = $r;
    }

    public abstract function square();
    public abstract function volume();
    public abstract function mass();
	//а - ребро(радіус для кулі)
	//h - висота
	//r - густина
}


class Cube extends Shape
{
    public function square()
   {
        return ($this->a * $this->a)*6;
   }

    public function  volume()
    {
        return ($this->a * $this->a * $this->a);
    }

    public function  mass()
    {
        return ($this->r * $this->volume() );
    }
	
}

class Parallelepiped extends Shape
{
    private $b;
    private $c;
	
	//b - ребро
	//c - ребро
	
    
    public function __construct($a, $h, $r, $b, $c)
    {
        $this->b = $b;
        $this->c = $c;
        parent::__construct($a, $h, $r);
    }
    
    public function square()
    {
        return (2 * ($this->a * $this->b + $this->b * $this->c + $this->c * $this->a));
    }

    public function  volume()
    {
        return ($this->a * $this->b * $this->c);
    }

    public function  mass()
    {
        return ($this->r * $this->volume());
    }
	
}

class Pyramid extends Shape
{
    private $b;
    private $l;
	
	//b - ребро
	//l - апофема (висота боковой грани)

    public function __construct($a, $h, $r, $b, $l)
    {
        $this->b = $b;
        $this->c = $l;
        parent::__construct($a, $h, $r);
    }

    public function perimetr()
    {
        return ($this->a * $this->a);
    }

    public function square()
    {
        return ($this->b + (($this->perimetr() * $this->l) / 2));
    }

    public function  volume()
    {
        return (1 / 3 * ($this->perimetr() * $this->h));
    }

    public function  mass()
    {
        return ($this->r * $this->volume() );
    }
}

class Sphere extends Shape
{
    public function __construct($a, $r)
    {
       parent::__construct($a, $r, 0);
    }

    public function square()
    {
        return (6 * ($this->a * $this->a));
    }

    public function  volume()
    {
        return ($this->a * $this->a * $this->a);
    }

    public function  mass()
    {
        return ($this->r * $this->volume() );
    }
}

$cube = new Cube(5, 4, 3);
$parallelepiped = new Parallelepiped(5, 4, 3, 10, 11);
$pyramid = new Pyramid(5, 4, 3, 10, 2);
$sphere = new Sphere(5, 4);

echo "Куб"."\n";
echo "Площа - ". $cube->square()."\n";
echo "Об'єм - ". $cube->volume()."\n";
echo "Маса - ". $cube->mass()."\n";

echo "Параллелепіпед"."\n";
echo "Площа - ". $parallelepiped->square()."\n";
echo "Об'єм - ". $parallelepiped->volume()."\n";
echo "Маса - ". $parallelepiped->mass()."\n";

echo "Піраміда"."\n";
echo "Площа - ". $pyramid->square()."\n";
echo "Об'єм - ". $pyramid->volume()."\n";
echo "Маса - ". $pyramid->mass()."\n";

echo "Куля"."\n";
echo "Площа - ". $sphere->square()."\n";
echo "Об'єм - ". $sphere->volume()."\n";
echo "Маса - ". $sphere->mass()."\n";

?>