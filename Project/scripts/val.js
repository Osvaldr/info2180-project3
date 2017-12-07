// JavaScript File
window.onload = function () {
  var myform = document.querySelector('#myform');

  myform.addEventListener('submit', function (element) {
    console.log('form submitted');
    var validationFailed = false;

    var firstname = document.querySelector('#firstname');
    var lastname = document.querySelector('#lastname');
    var telephone = document.querySelector('#telephone');
    var email = document.querySelector('#email');
    var website = document.querySelector('#website');

    // clear any previous error messages
    clearErrors();

    if (isEmpty(firstname.value.trim())) {
      validationFailed = true;
      //alert('You must fill in your First Name');
      displayErrorMessage(firstname, "You must fill in your First Name");
    };

    if (isEmpty(lastname.value.trim())) {
      validationFailed = true;
      // alert('You must fill in your Last Name');
      displayErrorMessage(lastname, "You must fill in your Last Name");
    }

    if (!isValidTelephoneNumber(telephone.value.trim())) {
      validationFailed = true;
      //alert('Incorrect format for telephone number.');
      displayErrorMessage(telephone, "Incorrect format for telephone number.");
    };

    if (!isValidEmail(email.value.trim())) {
      validationFailed = true;
      //alert('Incorrect format for email.');
      displayErrorMessage(email, "Incorrect format for email address.");
    };

    if (!isValidUrl(website.value.trim())) {
      validationFailed = true;
      //alert('Incorrect format for email.');
      displayErrorMessage(website, "Incorrect format for URL.");
    };

    if (validationFailed) {
      console.log('Please fix issues in Form submission and try again.');
      element.preventDefault();
    }
  });
};

/**
 * Check if value for a field is empty.
 */
function isEmpty(elementValue) {
  if (elementValue.length == 0) {
    // Or you could check if the value == ""
    console.log('field is empty');
    return true;
  }

  return false;
}

/**
 * Check if a valid telephone number was entered.
 */
function isValidTelephoneNumber(telephoneNumber) {
  return /^\d{3}-\d{3}-\d{4}$/.test(telephoneNumber);
}

/**
 * Check if a valid email address was entered.
 */
function isValidEmail(emailAddress) {
  return /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/.test(emailAddress);
}

function isValidUrl(websiteAddress) {
  return /^(?:(?:https?|ftp):\/\/)(?:\S+(?::\S*)?@)?(?:(?!10(?:\.\d{1,3}){3})(?!127(?:\.\d{1,3}){3})(?!169\.254(?:\.\d{1,3}){2})(?!192\.168(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/[^\s]*)?$/i.test(websiteAddress);
}

/**
 * Function to add an element after another element.
 */
function insertAfter(element, newNode) {
  element.parentNode.insertBefore(newNode, this.nextSibling);
}

// A better way to create insertAfter method.
// Object.prototype.insertAfter = function (newNode) {
//   this.parentNode.insertBefore(newNode, this.nextSibling);
// };

/**
 * Clear all error messages
 */
function clearErrors() {
  var elementsWithErrors = document.querySelectorAll('.error');
  //console.log(elementsWithErrors);
  for (var x = 0; x < elementsWithErrors.length; x++) {
    elementsWithErrors[x].setAttribute('class', '');
    elementsWithErrors[x].parentNode.removeChild(elementsWithErrors[x].nextElementSibling);
    //console.log(elementsWithErrors[x].nextElementSibling);
  }

}

/**
 * Display error message next to field.
 */
function displayErrorMessage(formField, message) {
  formField.setAttribute('class', 'error');
  var errorMessageText = document.createTextNode(message);
  var errorMessage = document.createElement('span');
  errorMessage.setAttribute('class', 'error-message');
  errorMessage.appendChild(errorMessageText);
  //formField.insertAfter(errorMessage);
  insertAfter(formField, errorMessage);
}