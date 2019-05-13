//calculate fine

	function CallMe(){
		var oneDayFine=50;
		var dateVariable=document.getElementById('IssuesDate').value;
		var dueDate=new Date("dateVariable");
		var currentDate=new Date();//Get the current Date
		var differenceinDays=Math.Abs(currentDate.getTime()-dueDate.getTime());
	
	if(differenceinDays>7)
	{
	var totalFine=oneDayFine*differenceinDays;
		document.getElementById('fine').value=totalFine;
	}
	else
	{
	window.alert('No Fine');
	}
}