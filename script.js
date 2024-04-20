let container = document.getElementsByTagName("body")[0]
let hour = new Date().getHours()
if(hour >= 18 || hour <= 6)container.classList.add("dark")
else container.classList.remove("dark")
