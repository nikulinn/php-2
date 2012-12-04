<?php



abstract class Shape

{
    protected $a;
    protected $r;
    protected $h;
    protected $name;
    
    function __construct($a, $r, $h)
    {
        $this->a = $a;
        $this->h = $h;
        $this->r = $r;
    }

    public function getName()
    {
        return $this->name;
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
    function __construct($a, $r, $h)
    {
        $this->name = "Куб";
        parent::__construct($a, $h, $r);
    }
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
        $this->name = "Параллелепіпед";        
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
        $this->name = "Піраміда";
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
        $this->name = "Куля";
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
echo "---------------------------------------------------------------------------------------------------------------------<br>";
echo "Основне завдання : <br><br>";
echo "Куб : <br>";
echo "Площа - ". $cube->square()."<br>";
echo "Об'єм - ". $cube->volume()."<br>";
echo "Маса - ". $cube->mass()."<br><br>";

echo "Параллелепіпед : <br>";
echo "Площа - ". $parallelepiped->square()."<br>";
echo "Об'єм - ". $parallelepiped->volume()."<br>";
echo "Маса - ". $parallelepiped->mass()."<br><br>";

echo "Піраміда : <br>";
echo "Площа - ". $pyramid->square()."<br>";
echo "Об'єм - ". $pyramid->volume()."<br>";
echo "Маса - ". $pyramid->mass()."<br><br>";

echo "Куля : <br>";
echo "Площа - ". $sphere->square()."<br>";
echo "Об'єм - ". $sphere->volume()."<br>";
echo "Маса - ". $sphere->mass()."<br><br>";

echo "---------------------------------------------------------------------------------------------------------------------<br>";
echo "Додаткове завдання : <br><br>";
//----------------------------------------------------------------------------------------------
$n = 5;

for ($y = 0; $y < $n; $y++) {
    for ($x = 0; $x < $n; $x++) {
        $p = rand(0,3);
        if ($p == 0){
            $arr[$x][$y] = new Cube(5, 4, 3);

        }
        elseif ($p == 1){
            $arr[$x][$y] = new Parallelepiped(5, 4, 3, 10, 11);

        }
        elseif ($p == 2){
            $arr[$x][$y] = new Pyramid(5, 4, 3, 10, 2);

        }
        elseif ($p == 3){
            $arr[$x][$y] = new Sphere(5, 4);

        }
    }
}
//----------------------------------------------------------------------------------------------
echo "Початкова таблиця : <br><br>";
echo "<table border=1 ><tr>";

for ($y = 0; $y < $n; $y++) {
    for ($x = 0; $x < $n; $x++) {
        echo "<td width=200>".$arr[$x][$y]->getName()." (".$arr[$x][$y]->mass().")</td>";
    }
    echo "</tr><tr>";
}
echo "</tr></table><br><br>";
//----------------------------------------------------------------------------------------------
echo "Відсортована таблиця : <br><br>";
function compare($x, $y)
{
    if($x->mass() == $y->mass())
        return 0;
    elseif ($x->mass() < $y->mass())
        return -1;
    else
        return 1;
}

for ($x = 0; $x < $n; $x++) {
    usort($arr[$x], compare);
}

echo "<table border=1 ><tr>";

for ($y = 0; $y < $n; $y++) {
    for ($x = 0; $x < $n; $x++) {
        echo "<td width=200>".$arr[$x][$y]->getName()." (".$arr[$x][$y]->mass().")</td>";
    }
    echo "</tr><tr>";
}
echo "</tr></table>";
