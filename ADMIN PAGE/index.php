<!DOCTYPE html>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="jqwidgets/styles/jqx.base.css" type="text/css" />
<link rel="stylesheet" href="jqwidgets/styles/jqx.classic.css" type="text/css" />
<script type="text/javascript" src="scripts/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="jqwidgets/jqxcore.js"></script>
<script type="text/javascript" src="jqwidgets/jqxbuttons.js"></script>
<script type="text/javascript" src="jqwidgets/jqxscrollbar.js"></script>
<script type="text/javascript" src="jqwidgets/jqxmenu.js"></script>
<script type="text/javascript" src="jqwidgets/jqxdata.js"></script>
<script type="text/javascript" src="jqwidgets/jqxgrid.js"></script>
<script type="text/javascript" src="jqwidgets/jqxgrid.selection.js"></script>
<link rel="stylesheet" href="css/bootstrap.css">
    <script type="text/javascript">
    $(document).ready(function () {
    // prepare the data
    var source ={
        datatype: "json",
        datafields: [{ name: 'city' }],
        url: 'data.php'
    };
    $("#jqxgrid").jqxGrid({
        source: source,
        theme: 'classic',
        columns: [{text: 'City', datafield: 'city', width: 120 }]
    });
    });


     </script>

<html>


<head>

<title>
	fEMR Admin Page
</title>
</head>

<body>


<div id='jqxWidget'>
        <div id="jqxgrid"></div>
    </div>
</body>


<footer>
    <hr />
    <div class="row">
        <div class="col-xs-6">
            <p class ="text-left">fEMR 2.1.5 &copy; 2015</p>
        </div>
        <div class="col-xs-6">
            <p class="text-right">Designed for use in Google Chrome</p>
        </div>
    </div>
</footer>

        </div>

</html>