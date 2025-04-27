// JavaScript Document


$(document).ready(function() {
// Initializing arrays with city names.

var PGDCA = [
{display: "C++", value: "C++"},
{display: "JAVA", value: "JAVA"},
{display: "DotNet", value: "DotNet"},
{display: "Oracle,sql", value: "Oracle,sql"},
{display: "Sqlserver",value: "Sqlserver"}];
var DCA = [{
display: "AutoCad",value: "AutoCad"},
{display: "C", value: "C"},
{display: "HTML", value: "HTML"},
{display: "Photoshop", value: "Photoshop"},
{display: "Page Maker", value: "Page Maker"},
{display: "Tally",value: "Tally"}];
var C = [{
display: "C",value: "C"}
];



// Function executes on change of first select option field.
$("#courses").change(function() {
var select = $("#courses option:selected").val();
switch (select) {
case "PGDCA":
options1(DCA);
options2(DCA);
options3(PGDCA);
options4(PGDCA);
break;
case "DCA":
options1(DCA);
options2(DCA);
options3();
options4();
break;
case "C":
options1();
options2();
options3();
options4();
break;
case "C++":
options1();
options2();
options3();
options4();
break;
case "JAVA":
options1();
options2();
options3();
options4();
break;
case "DotNet":
options1();
options2();
options3();
options4();
break;
case "CORE JAVA":
options1();
options2();
options3();
options4();
break;
case "Adv. JAVA":
options1();
options2();
options3();
options4();
break;
case "J2EE":
options1();
options2();
options3();
options4();
break;
case "HTML":
options1();
options2();
options3();
options4();
break;
case "AutoCad":
options1();
options2();
options3();
options4();
break;
case "Photoshop":
options1();
options2();
options3();
options4();
break;
case "Page Maker":
options1();
options2();
options3();
options4();
break;
case "Tally":
options1();
options2();
options3();
options4();
break;
case "Sql":
options1();
options2();
options3();
options4();
break;
default:
$("#coverage").empty();
//$("#coverage").append("<option>--Select--</option>");
break;
}
});
// Function To List out Cities in Second Select tags
function options1(arr) {
$("#options1").empty(); //To reset cities
//$("#options1").append("<option>--Select--</option>");
$(arr).each(function(i) { //to list cities
$("#options1").append("<option value=\"" + arr[i].value + "\">" + arr[i].display + "</option>")
});
}



function options2(arr) {
$("#options2").empty(); //To reset cities
//$("#options2").append("<option>--Select--</option>");
$(arr).each(function(i) { //to list cities
$("#options2").append("<option value=\"" + arr[i].value + "\">" + arr[i].display + "</option>")
});

}

function options3(arr) {
$("#options3").empty(); //To reset cities
//$("#options3").append("<option>--Select--</option>");
$(arr).each(function(i) { //to list cities
$("#options3").append("<option value=\"" + arr[i].value + "\">" + arr[i].display + "</option>")
});

}

function options4(arr) {
$("#options4").empty(); //To reset cities
//$("#options4").append("<option>--Select--</option>");
$(arr).each(function(i) { //to list cities
$("#options4").append("<option value=\"" + arr[i].value + "\">" + arr[i].display + "</option>")
});

}

});