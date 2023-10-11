table = new Tabulator("empresas", {
    data: <?= json_encode($empresas) ?>,
    height:"311px",
    layout:"fitColumns",
    placeholder:"No Data Set",
    columns:[
    {title:"RAZON SOCIAL", field:"razon_social"}, //frozen column
    {title:"RFC", field:"rfc" },
    ],
});

document.getElementById("download-csv").addEventListener("click", function(){
    table.download("csv", "data.csv");
});

//trigger descarga pdf
document.getElementById("download-pdf").addEventListener("click", function(){
    table.download("pdf", "data.pdf", {
        orientation:"portrait", //set page orientation to portrait
        title:"", //add title to report
    });
});
