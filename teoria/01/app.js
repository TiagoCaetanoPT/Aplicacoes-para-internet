function handleClickOfImg(e){
	e.target.style.display = 'none';
}

var imgs = document.getElementsByTagName('img');

for (var i = 0; i < imgs.length; i++){
	imgs[i].addEventListener("click", handleClickOfImg);
}


