function calculate($num1, $num2, $operator = "a"){
$result = 0;

if ($operator == "a")
{
$result = $num1 + $num2;
}
else if ($operator == "s")
{
$result = $num1 - $num2;
}
else if ($operator == "m")
{
$result = $num1 * $num2;
}
else if ($operator == "d")
{
$result = $num1 / $num2;
}
else
{
$result = $num1 + $num2;
}

return $result
}