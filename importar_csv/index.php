<!DOCTYPE html>
<html>
<head>
    <title></title>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<body>
<script type="text/javascript">

$(document).ready(function(){

    $("select").on('change', function(){

        var x = this.selectedIndex;

        if (this.value == 'csv') {

            $("#a").show();

        } else {

             $("#a").hide();

        }

            if (this.value == 'xlsx') {

            $("#b").show();

        } else {

             $("#b").hide();

        }

            if (this.value == 'xlm') {

            $("#c").show();

        } else {

             $("#c").hide();

        }



    })


    $("#a").css("display","none");
    $("#b").css("display","none");
    $("#c").css("display","none");

})


</script>

<form method="post" action="importar_sql.php" enctype="multipart/form-data">
    <table align="center" >
        <tr>
            <td colspan="2">
                Seleccione el tipo de archivo:
            </td>
            <td>
                <select>
                    <option disabled selected>Seleccione...</option>
                    <option value='csv' >csv</option>
                    <option value='xlsx' >xlsx</option>
                    <option value='xlm' >xlm</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Seleccione el archivo a cargar
            </td>
            <td>
                <input type="file" accept=".csv" name="csv" size="10" id="a" />
                <input type="file" accept=".xlsx" name="xlsx" size="10" id="b" />
                <input type="file" accept=".xml" name="xml" size="10" id="c" />
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Cargar el archivo a la base
            </td>
            <td align="center" colspan="5">
                <input type="submit" value="Cargar" id="submit" />
            </td>
        </tr>
    </table>
</form>
</div>
</body>
</html>
<div>