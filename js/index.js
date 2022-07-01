let body = document.querySelector('.body');
let ContentAddIMG = document.querySelector('.Content_AddIMG');
let ContentFormAnonimUser = document.querySelector('.Content_FormAnonimUser');
let CancelButForm = document.querySelector('#CancelButForm');
ContentAddIMG.addEventListener('click', function () {
ContentAddIMG.style.display = 'none';
ContentFormAnonimUser.style.display = 'flex';
});
CancelButForm.addEventListener('click', function () {
  ContentAddIMG.style.display = 'block';
  ContentFormAnonimUser.style.display = 'none';
  });

let HeaderUserBlock = document.querySelector(".Header_UserBlock");
let FormAuthorization = document.querySelector("#FormAuthorization");
let FormAuthorizationReg = document.querySelector("#FormAuthorizationReg");

let FormAuthorization_Reg = document.querySelector('#FormAuthorization_Reg');
let FormAuthorization_Exit = document.querySelector('#FormAuthorization_Exit');

let FormAuthorizationReg_Entrance = document.querySelector('#FormAuthorizationReg_Entrance');
let FormAuthorizationReg_Exit = document.querySelector('#FormAuthorizationReg_Exit');

let HeaderTextEntrance = document.querySelector(".Header_TextEntrance");


if ((HeaderTextEntrance.innerHTML).trim() == 'Войти') {
HeaderUserBlock.addEventListener('click', function () {
  FormAuthorization.style.display = 'block';
});
}
FormAuthorization_Reg.addEventListener('click', function () {
  FormAuthorization.style.display = 'none';
  FormAuthorizationReg.style.display = 'block';
});
FormAuthorization_Exit.addEventListener('click', function () {
  FormAuthorization.style.display = 'none';
});

FormAuthorizationReg_Entrance.addEventListener('click', function () {
  FormAuthorization.style.display = 'block';
  FormAuthorizationReg.style.display = 'none';
});
FormAuthorizationReg_Exit.addEventListener('click', function () {
FormAuthorizationReg.style.display = 'none';
});

let ButRegister = document.querySelector('#ButRegister');
let FormRegister = document.querySelector('#FormRegister');

//Проверка на ошибки регистрации
let MessageToTheUser = document.querySelector('#MessageToTheUser');
function UserVerification(ErrorInput) {

  if (ErrorInput != '' ) {
    MessageToTheUser.innerHTML = ErrorInput;
    FormAuthorizationReg.style.display = 'block';
  } else {
     MessageToTheUser.innerHTML = '';
  }

  if(ErrorInput == 'Заполните все поля!') {
    FormAuthorizationReg.style.display = 'none';
  }

}

//Проверка на ошибки авторизации
let MessageToTheUserAuth = document.querySelector('#MessageToTheUserAuth');


function UserVerificationAuth(ErrorInputAuth) {

  if (ErrorInputAuth != '' ) {
    MessageToTheUserAuth.innerHTML = ErrorInputAuth;
    FormAuthorization.style.display = 'block';
  } else {
     MessageToTheUserAuth.innerHTML = '';
  }

}

//Панель редактирования
function AddEditPanel(WhoCameIn) {

let Content_comments_content_Data_edit = document.querySelectorAll('.Content_comments_content_Data_edit');
let Content_comments_content_feedback = document.querySelectorAll('.Content_comments_content_feedback');

let blackout = document.querySelector('.blackout');
let Content_FormEdit = document.querySelector('.Content_FormEdit');
let Content_FormEdit_ButBack = document.querySelector('#Content_FormEdit_ButBack');
let Content_FormEdit_textarea = document.querySelector('#Content_FormEdit_textarea');
let FormEditId = document.querySelector('#FormEditId');

let DataPost = document.querySelector('#DataPost');
let DateFormEdit = document.querySelector('#DateFormEdit');

Content_FormEdit_ButBack.addEventListener('click', function () {
  blackout.style.display='none';
  Content_FormEdit.style.display='none';
});

if(WhoCameIn == 'Admin'){
for (var i = 0; i < Content_comments_content_Data_edit.length; i++) {

  let Content = Content_comments_content_feedback[i].innerHTML;

  Content_comments_content_Data_edit[i].addEventListener('click', function () {
    blackout.style.display='block';
    Content_FormEdit.style.display='flex';
    let str = this.innerHTML;
    var mySubString = str.substring(str.lastIndexOf("|") +1,str.lastIndexOf("/"));
    Content_FormEdit_textarea.innerHTML = Content ;
    FormEditId.innerHTML = mySubString.slice(0,-2);

  });

}
} else if (WhoCameIn != '') {

for (var i = 0; i < Content_comments_content_Data_edit.length; i++) {

  Content_comments_content_Data_edit[i].addEventListener('click', function () {
    blackout.style.display='block';
    Content_FormEdit.style.display='flex';
    let str = this.innerHTML;
    var mySubString = str.substring(str.lastIndexOf("|") +1,str.lastIndexOf("/"));
    FormEditId.innerHTML = mySubString.slice(0,-2);
    DateFormEdit.innerHTML = DataPost.innerHTML;
  });

}

}

}

function NextPage(num,result) {
  let NextPage_Count = document.querySelector('#NextPage_Count');
  let Content_PageText = document.querySelector('.Content_PageText');
  if (result !='') {
  NextPage_Count.value = num +10;
  let numstr = String(num +10);
  Content_PageText.innerHTML = "Страница "+numstr[0];
} else{
  Content_PageText.innerHTML = "Записей больше нет";
}
}

function BackPage(num,result) {
  let BackPage_Count = document.querySelector('#BackPage_Count');
  let Content_PageText = document.querySelector('.Content_PageText');


  if (result !='') {
  BackPage_Count.value = num -10;
  let numstr = String(num -10);
  Content_PageText.innerHTML = "Страница "+numstr[0];
  console.log(result);
} else{
  Content_PageText.innerHTML = "Записей больше нет";
}

}
