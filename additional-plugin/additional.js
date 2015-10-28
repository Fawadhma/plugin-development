// JavaScript Document

function validateform(){
	var textarea=document.forms["text_form"]["extra-text"].value;
	var location=document.forms["text_form"]["location-text"].value;
	var homepage=document.forms["text_form"]["show-onhome"].value;
	var page=document.forms["text_form"]["show-onpage"].value;
	var single=document.forms["text_form"]["show-onsinglepage"].value;
	var custom=document.forms["text_form"]["show-oncustomtemplate"].value;
	var front=document.forms["text_form"]["show-onfrontpage"].value;
	
	if (textarea==null || textarea=="")
  {
  alert("Please insert Text in textarea");
  return false;
  }
  
  if (location==null || location=="")
  {
  alert("Please select location");
  return false;
  }
  
  if (homepage==null || homepage=="")
  {
  alert("Please select value");
  return false;
  }
  
  if (page==null || page=="")
  {
  alert("Please select value");
  return false;
  }
  
  if (single==null || single=="")
  {
  alert("Please select value");
  return false;
  }
  
  if (custom==null || custom=="")
  {
  alert("Please select value");
  return false;
  }
  
  if (front==null || front=="")
  {
  alert("Please select value");
  return false;
  }
}