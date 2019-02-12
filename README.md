# ForEach
Simple PHP Function that will dump an Array in a visual HTML Table. 
Can be used as an replacement for PHPs "var_dump()". If you work with lots of arrays it is a simple but very helpfull script while developing (not made for productive/public).

Just include the file fe.php and start using it with:
$var = fe($myArray);
or
fe($myArray, false);
depending on if you want to save the created HTML code in a variable or directly output it (echo).
