<?php

$currentValue=0;
$input=[];

function getInputAsString($values){
   
        $o ="";
        foreach($values as $value){
            $o .=$value;
        }
        return $o;
    }
    function getInputAsnum($values){
   
       $n=getInputAsString($values);
       settype($n, "integer");
        return $n;
    }
 


function calculateInput($userInput){
 
     $row=getInputAsString($userInput);
     $math_string ="print (".$row.");";
     $currentValue=eval($math_string);
    //  return  $currentValue;

}
if($_SERVER['REQUEST_METHOD']=="POST"){
   if(isset($_POST['input'])){
      $input=json_decode($_POST['input']);
   }

    if(isset($_POST)){
        foreach($_POST as $key=>$value){

              if($key=='CE'){
                array_pop($input);
             }
             else if($key=='AC'){
                $input=[];
                $GLOBALS['currentValue']=0;
             }
             else if(is_numeric($key) ||$key=="+"||$key=="-"||$key=="*"||$key=="/"||$key=="%"){
                 $input[]=$key;
                 
             }
             else if($key=="sin"){
                $currentValue=sin(getInputAsnum($input));
                
             }
             else if($key=="cos"){
                $currentValue=cos(getInputAsnum($input));
             }
             else if($key=="tan"){
                $currentValue=tan(getInputAsnum($input));
                
             }
             else if($key=="y"){
                $currentValue=pow(getInputAsnum($input),2);
             }
             else if($key=="√"){
                $currentValue=sqrt(getInputAsnum($input));
             }
             else if($key=="log"){
                $currentValue=log(getInputAsnum($input));
             }
             else if($key=="π"){
                $currentValue=pi();
             }
             else if($key=="e"){
                $currentValue=2.71828182846;;
             }
             else if($key=="x!"){
                 $f = 1;
                 $num = getInputAsnum($input);
                for ($i = 1; $i <= $num; $i++) {
                    $f = $f * $i;
                }
            
                $i = $i - 1;
            
                $currentValue = $f;
             }
             else if($key=='='){
                $currentValue=calculateInput($input);
                
            }
       
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scientific Calculator</title>
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">
        <form  method="post">
        <div class="display">
            <input type="hidden" name="input" value='<?php echo json_encode($input)?> '/>
            <input id="screen" type="text"  value='<?php echo getInputAsString($input)?>'/>
            <br>
            <input id="screen" type="text"  value='<?php echo $currentValue?>'/>
        </div>

        <div class="btns">
            <div class="row">
                <button id="ce"  name="CE">CE</button>
                <button name="x!">x!</button>
                <button class="btn" name="(">(</button>
                <button class="btn" name=")">)</button>
                <button class="btn" name="%">%</button>
                <button id="ac"     name="AC">AC</button>
            </div>
            <div class="row">
                <button  name="sin">sin</button>
                <button  name="π">π</button>
                <button class="btn" name="7">7</button>
                <button class="btn" name="8">8</button>
                <button class="btn" name="9">9</button>
                <button class="btn" name="/">÷</button>
            </div>

            <div class="row">
                <button  name="cos">cos</button>
                <button  name="log">log</button>
                <button class="btn" name="4">4</button>
                <button class="btn" name="5">5</button>
                <button class="btn" name="6">6</button>
                <button class="btn" name="*">×</button>
            </div>

            <div class="row">
                <button  name="tan">tan</button>
                <button  name="√">√</button>
                <button class="btn" name="1" >1</button>
                <button class="btn" name="2">2</button>
                <button class="btn" name="3">3</button>
                <button class="btn" name="-">-</button>
            </div>

            <div class="row">
                <button  name="e">e</button>
                <button  name="y">x <span class="sp1">y</span>
                </button>
                <button class="btn" name="0">0</button>
                <button id="eval"  name="=">=</button>
                <button class="btn" name="+">+</button>
            </div>
        </div>
        </form>
    </div>
    <script src="script.js"></script>
</body>


</html>
