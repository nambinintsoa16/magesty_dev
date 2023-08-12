$(document).ready(function(){
    //pie
var ctxP = document.getElementById("pieChart").getContext('2d');
var myPieChart = new Chart(ctxP, {
type: 'pie',
data: {
labels: ["Satisfait", "Non satisfait"],
datasets: [{
data: [4, 1],
backgroundColor: ["#F7464A", "#4D5360"],
hoverBackgroundColor: ["#FF5A5E", "#616774"]
}]
},
options: {
responsive: true
}
});

});
