"use strict"
// это нужно!
var VarSort = document.getElementById('inputList1');			//
var VarBtnSort = document.getElementById('sort');			// button
var VarArrayAll = document.getElementsByClassName('heshtegLine');

// неуспешное Все возможные эмоции всех фото
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

// var VarArrayNoRepeat = ["все эмоции"];
// var VarArrayTimer = [];
// for (var i = 0; i < VarArrayAll.length; i++) {
// 	var VarArrayTimer = VarArrayAll[i].innerHTML.split(', ');
// 	for(var j = 0; j < VarArrayAll.length; j++) {
// 		if (!VarArrayAll[i].innerHTML.toLowerCase().includes(VarArrayTimer[i])) {
// 			VarArrayNoRepeat.push(VarArrayTimer[i]);
// 		}
// 	}
// }
// alert(VarArrayNoRepeat);

// неуспешное добавление эмоций в список выбора
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// document.getElementById('list-ul-li').length = VarArrayNoRepeat.length;
// for(var i = 0; i < document.getElementById('list-ul-li').length; i++) {
// document.getElementById('list-ul-li').children[i].innerHTML = VarArrayNoRepeat[i];
// }

// Рабочий код
// choice from list
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
var VarListBlock = document.getElementById('list-ul1');			// весь блок
var VarinputList1 = document.getElementById('inputList1');		// поле ввода
var VarListin = document.getElementById('list-ul-li');			// блок список

			// выбор по нажатию
VarListin.onmousedown = function(e) {
	var VarCheckedBefor = document.getElementsByClassName("checked");	// получаем прежде выбранный елемент виде масива
	var VarCheckedNow = e.target;			// выбранный елемент
	
	if(VarCheckedBefor[0]) {VarCheckedBefor[0].classList.toggle("checked");};	// убираем прежде выбранный елемент (в случае, если он был)
	VarCheckedNow.classList.add("checked");	// устанавливаем новый выбранный елемент 
	
	VarinputList1.setAttribute('value', VarCheckedNow.innerHTML);		// записываем выбранный елемент в инпут HTML
	//alert(VarinputList1.getAttribute('value'));
	VarinputList1.value = VarinputList1.getAttribute('value');			// записываем выбранный елемент в инпут обьекта DOM
	//alert(VarinputList1.value);
}

			// ищем варианты возможных совпадений списка и поиска 
VarinputList1.oninput = function () {											// когда начинается изменение инпута
	for (var i=0; i < (VarListin.children.length); i++) {					// перебираем весь список
	VarListin.children[i].style.setProperty('display','none');			// скрываем каждый элемент списка
	
	if (VarListin.children[i].innerHTML.toLowerCase().includes(VarinputList1.value.toLowerCase())) {				// если есть совпадения
		VarListin.children[i].style.setProperty('display','block');						// показываем элемент списка
	};
	}
}

//close foto
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
var VarButtonClose = document.querySelector('.imgclose');
VarButtonClose.addEventListener('mousedown', FunButtonClose);
function FunButtonClose() {   
			document.getElementById('imgscreen').style.display = 'none';
};

// open foto
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//document.querySelectorAll("img.sss").addEventListener('click',  function(event) {
document.querySelector(".sort_result").addEventListener('click',  function(event) {
	var Mtarget = event.target; // где был клик?

	//if (Mtarget.classList.contains('picturis')) { //return; // не на img? тогда не интересует
	//if (Mtarget.classList.contains('sss') | Mtarget.tagName == "img") { //return; // не на img? тогда не интересует
	if (Mtarget.tagName == "IMG") { //return; // не на img? тогда не интересует
	document.getElementById('imgscreen').style.display = 'flex'; // открыть img
	document.getElementById('imgmax').src = Mtarget.src; // скопировать ссылку для img

		//alert(document.getElementsByClassName('heshteg')[0].children[0].children[0].innerHTML);
		//for (var l = 0; l < document.getElementsByClassName('heshteg')[0].children[0].children.length; l++) {
		//document.getElementsByClassName('heshteg')[0].children[0].removeChild(document.getElementsByClassName('heshteg')[0].children[0].children[0]);
		//}
		//document.getElementsByClassName('heshteg')[0].children[0].removeChild(document.getElementsByClassName('heshteg')[0].children[0].children[0]);
		
		document.getElementById('heshtegActive').removeChild(document.getElementsByClassName('heshteg')[0].children[0]);

		//var VarNewTegUl = document.createElement('ul');
		document.getElementById('imgscreen').children[1].appendChild(document.createElement('ul'));
	for (var i = 0; i < Mtarget.parentNode.parentNode.children[1].children[0].innerHTML.split(" ").length; i++) {
		var VarNewTegLi = document.createElement('li');
		document.getElementById('imgscreen').children[1].children[0].appendChild(VarNewTegLi);
		document.getElementById('imgscreen').children[1].children[0].children[i].innerHTML = Mtarget.parentNode.parentNode.children[1].children[0].innerHTML.split(" ")[i];
	}

	}
 });

 // rotate icon from addfoto pause
 // +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 document.querySelector("#addfoto").addEventListener('click',  function(event) {
	 document.getElementById('iconnext').style.animation = 'iconnext 1s linear normal infinite';
	 setTimeout(function () {
		document.getElementById('iconnext').style.webkitAnimationPlayState = 'paused';
	}, 1000);
 });

 // filter 
 // +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

 //var VarArrayNew = 0;
 // последовательное сортирование
 // ------------------------------------------------------------------------------------
//VarBtnSort.onmousedown = function(e) {
//	//alert(document.getElementById('inputList1'));
//	//alert(document.getElementById('inputList1').getAttribute('value'));
//	//alert(Mtarget);
//	//alert(VarArrayAll[0].innerHTML);
//	alert(VarArrayAll.length);
//	//var VarArrayNew = 0;
//	//VarArrayAll.forEach(function(i, content, VarArrayAll) {
//	//	alert(VarArrayAll[0]);
//	//	alert(VarArrayAll[i] + ":" + content);
//	//});
//	//var VarArrayNew = VarArrayAll.filter( function(VarArray0) {
//	for (var i = 0; i < VarArrayAll.length; i++) {
//	////for (var i=0; i < (VarArrayAll.length); i++) {					// перебираем весь список
//	//return VarArray0;	
//	if (!VarArrayAll[i].innerHTML.includes(VarSort.getAttribute('value'))) {				// если есть совпадения
//		VarArrayAll[i].offsetParent.style.display = 'none';						// все дело в родительских элементах!
//		//alert(VarArrayNew.length);
//	};
//	}
//	//	//return VarArrayAll[i];
//	////if(VarArrayAll[i].innerHTML)
//	////alert(VarArrayAll[0]);
//	////};
//	//});
//	//alert(VarArrayNew[0].innerHTML);
//}
// ------------------------------------------------------------------------------------
VarBtnSort.onmousedown = function(e) {
	for (var i = 0; i < VarArrayAll.length; i++) {
		VarArrayAll[i].parentNode.parentNode.parentNode.style.setProperty('display','block');
	}
	if (!VarSort.value.includes('все эмоции')) {	// getAttribute('value')
		for (var i = 0; i < VarArrayAll.length; i++) {
			if (!VarArrayAll[i].innerHTML.toLowerCase().includes(VarSort.value.toLowerCase())) {				// если есть совпадения getAttribute('value')
				VarArrayAll[i].parentNode.parentNode.parentNode.style.setProperty('display','none');				// копировали элемент масива
			} else {};
		}
	}
}

// Все возможные эмоции всех фото
// ================================================================================================


// ==================================================================================================

