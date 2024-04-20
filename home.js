let github = document.getElementById("github")
let time = new Date().getHours()
if(time >= 18 || time <= 6)github.style.filter="invert()"
else github.style.filter="none"