<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
</head>
<link href='https://fonts.googleapis.com/css?family=Rock+Salt' rel='stylesheet' type='text/css'>

<body>


Usted tiene funcion <input  type="text" id="funcion" name="funcion" value="<?php echo $_POST['funcion'];
$funcion=$_POST['funcion'];?> "readonly>
<br>
Usted tiene derivada <input type="text" id="derivada" name="derivada" value=" <?php echo $_POST['derivada']; 
$derivada=$_POST['derivada'];
?>"readonly> <br>
<p> Usted tiene intervalo a trabajar <input input id="intervalo" name="intervalo" type="text" name="intervalo" value="<?php echo (int)$_POST['intervalo']; 
$intervalo=$_POST['intervalo'];
$interacciones=[""];
$interacciones[0]=$intervalo;
?>"readonly/></p> <br>
Usted tiene tolerancia <input type="text" id="tolerancia" name="tolerancia" value="<?php echo $_POST['tolerancia'];
$tolerancia=$_POST['tolerancia'];
$ecuacion="";
?>"readonly>

<br> 

<?php 

$ecuacion = str_ireplace("x", "X", $funcion);
$derivada1 = str_ireplace("x", "X", $derivada);
echo $ecuacion;

$potencias = str_ireplace("^", "**", $ecuacion);
$potenciasderivada = str_ireplace("^", "**", $derivada1);
echo $potencias;

?>

<p>funcion final para la primera interaccion es   : <input input id="ecuacionfinal" type="text" name="funcionfinal" value=" 

<?php 

$unirfuncion=[""];

for ($i = 1; $i <= strlen($potencias); $i++) {

    if($potencias[0]=="."){ 
        $potencias[0]=" ";
    } elseif ($potencias[$i-1]=="."){    
        $potencias[$i-1]="*";

        }
}

     echo $potencias;


?>"readonly /></p>

<br>

<p>derivada final es : <input input id="derivadafinal" type="text" name="derivadafinal" value=" 

<?php 

$unirderivada=[""];

for ($i = 1; $i <= strlen($potenciasderivada); $i++) {

    if($potenciasderivada[0]=="."){ 
        $potenciasderivada[0]=" ";
    } elseif ($potenciasderivada[$i-1]=="."){    
        $potenciasderivada[$i-1]="*";

        }
}
     echo $potenciasderivada;

?>" readonly/></p>

<button type="button" onclick="valorEcuacion()">calcular</button>


<p> el valor de la iteracion nro : <input type="text" name="nuevatolerancia" id="nuevatolerancia"/>  
</p>



<script type="text/javascript">
	function valorEcuacion() {
    nointeracciones =[];
    resultados=[];
    errorponcentual=[];
    tolerancia1 =document.getElementById("tolerancia").value;
    l=0;
    
    intervalo = document.getElementById("intervalo").value;
    intervalo1=0;
    i=intervalo;
    
    
    while  (i>=tolerancia1) {

    ecuacion1 = document.getElementById("funcion").value;
    ecuacion2 = document.getElementById("derivada").value;
    
    numerador = ecuacion1.replaceAll("^","**"); 
    numerador = numerador.replaceAll("x", "*"+intervalo); 
    if (numerador.charAt(0)=="*" ) {
        numerador = numerador.replace("*","");
    }
   
    denominador = ecuacion2.replaceAll("^","**"); 
    denominador = denominador.replaceAll("x","*"+intervalo); 
    if (denominador.charAt(0)=="*" ) {
        denominador = denominador.replace("*","");
    }
    resultados[l]=intervalo;

    intervalo1 = eval((intervalo))-(eval((numerador))/eval((denominador)));
    i=(intervalo - intervalo1);
    intervalo=intervalo1;

    nointeracciones[l]=l;
    
    if (l==0) {

        errorponcentual[l]="---";
    } else {

        errorponcentual[l]=resultados[l-1]-resultados[l];
    }
    
    
    l++;
    
    }

    document.getElementById("nuevatolerancia").value=intervalo1;
    //console.log(tolerancia1);
    //console.log(i);
    
    
    n=0;

    const $cuerpoTabla = document.querySelector("#cuerpoTabla");
    
    nointeracciones.forEach(nointeraccion => {
        
    const $tr = document.createElement("tr");
   
    let $vuelta = document.createElement("td");
    $vuelta.textContent = nointeracciones[n]+1; 
    $tr.appendChild($vuelta);
    
    let $equisubi = document.createElement("td");
    $equisubi.textContent = resultados[n];
    $tr.appendChild($equisubi);
    
    let $erroresp = document.createElement("td");
    $erroresp.textContent = errorponcentual[n];
    $tr.appendChild($erroresp);
   
    $cuerpoTabla.appendChild($tr);
  
    n++;

});

    

    }
</script> 

<h1>Tabla Metodo Newton Raphson</h1>
        
        <table>
            <thead>
                <tr>
                    <th>interaccion </th>
                    <th>X</th>
                    <th>Error Porcentual</th>
                </tr>
            </thead>
            <tbody id="cuerpoTabla">

            </tbody>
        </table>


        

    













</body>
</html>