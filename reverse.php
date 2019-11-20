<?php
    $string = '(a(a)a)';
    hasMatchedParenthesis($string);
    function hasMatchedParenthesis($string) {
        $counter = 0;
        $counter2 = 0;
        $length = strlen($string);
        for ($i = 0;$i < $length; $i++) {
            $parenthesis = $string[$i];
            if($parenthesis == '('){ 
                $counter++;
            }elseif($parenthesis == ')') {
                $counter2++;
            }else if($parenthesis == '{'){
                $counter++;
            }elseif($parenthesis == '}') {
                $counter2++;
            }
        }
        if($counter == $counter2)
            echo 'OK';
        else
            echo 'NG';
    }

    $string = 'this is a pen.';
    reverse($string);
    function reverse($string){
        $index = strlen($string);
        $reverse = '';
        for($i = $index; $i > 0; $i--){

            $reverse = $reverse . '' . $string[$i - 1];
        }
        echo $reverse;
    }

    fibonacci(1000);
    function fibonacci($num){
        $sum = 0;
        for($i = 0; $i <= $num; $i++){
            $sum = $sum + $i;
            echo '<pre>';
            echo 'f(' . $i . ')=' . $sum;
        }
    }
?>