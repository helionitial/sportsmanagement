function checkForm()
{

    var teamnameInput = document.getElementById("teamnameInput");
    var leagueInput = document.getElementById("leagueInput");
    
    var validRegExp = new RegExp(/^[A-Za-z0-9._]{1,32}$/);
    var emailRegExp = new RegExp(/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/);
    
	if(teamnameInput.value === "" || leagueInput.value === "")
	{
        alert("Please provide all of the requested information");
        return false;
    }
    
	else
		return true;
  
}
