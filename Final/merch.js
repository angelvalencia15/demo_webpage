//get credit from merch.php
// UPDATING THE USER CREDIT
function update_credit(){
  //make AJAX POST request
  const request = new XMLHttpRequest();

  request.onload =function(){
    if(this.status === 200){
      //if successful, credit is displayed
      //console.log(this.responseText);
      const p1 = document.getElementById('EmptyP1');
      p1.innerHTML = `Your Credit: $${credit.toFixed(2)}`;
      //console.log("Successful updates credit");
    }
  };
  request.open('POST', 'money.php');
  request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  request.send(`username=${username}&credit=${credit}`);

}

//ATTACHING PRICES TO <span> ELEMENTS IN merch.php
let prices = [50, 5, 30, 15];
const spans = document.getElementsByTagName('span');
for (let i = 0; i < spans.length; ++i) {
  spans[i].innerHTML = `$${prices[i].toFixed(2)}`;
    }

// grabbing each image element to attach an event listener
const images = document.getElementsByTagName('img');
const checkboxes = [
  document.getElementById('JerseyInput'),
  document.getElementById('WhistleInput'),
  document.getElementById('FlagsInput'),
  document.getElementById('WatchInput')
  ];

// add event listeners to images, connected to checkbox
for (let i = 0; i < images.length; ++i) {
  images[i].addEventListener('click', function() {
    checkboxes[i].checked = !checkboxes[i].checked; 
    //status changes on every click, to its opposite
    });
  }

// CHECKOUT BUTTON EVENT LISTENER
const checkoutButton = document.getElementById('Checkout');
const P2 = document.getElementById('EmptyP2');

checkoutButton.addEventListener('click', function() {

  applyCoupon();
  
  let selectedPrices = [];
  
  for (let i = 0; i < checkboxes.length; ++i) {
    if (checkboxes[i].checked) {
      selectedPrices.push(prices[i]);
    }
  }
  sales_total(selectedPrices);
});

// CALCULATE SALES TAX
function sales_total(arr) {
  // Calculate the total of selected items
  let sum = 0;
  for (let i = 0; i < arr.length; ++i) {
    sum += arr[i];
  }
  // Calculate sales tax (7.25%)
  let tax = sum * 0.0725;
  // Apply rounding and Bankers Rounding for tax
  let taxRound = Math.round(tax * 100) / 100;
  let thirdDecimal = Math.floor(tax * 1000) % 10;
  if (thirdDecimal === 5) {
    let secondDecimal = Math.floor(tax * 100) % 10;
    taxRound = (secondDecimal % 2 === 1) ? Math.ceil(tax * 100) / 100 : Math.floor(tax * 100) / 100;
  }
  let finalTotal = sum + taxRound;
  
  // check if credit is sufficient and update the page or alert the user
  if (finalTotal > credit) {
    alert("You do not have sufficient credit for this purchase.");
  } else {
    //P2.innerHTML = `Total before tax: $${sum.toFixed(2)}, Total after tax: $${finalTotal.toFixed(2)}`;
    P2.innerHTML = `$${sum.toFixed(2)} <br> + sales tax (7.25%) <br> = $${finalTotal.toFixed(2)}`;
    credit -= finalTotal;
    update_credit();
    
    // Uncheck and disable checkboxes of purchased items
    for (let i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].checked) {
        checkboxes[i].checked = false;
        checkboxes[i].disabled = true;
        images[i].removeEventListener('click', function() {}); // Disable image click as well
      }
    }
  }
}

// APPLY THE COUPON
function applyCoupon() {
  const coupon = textbox.value;
  let addedCredit = 0;

  if (coupon === "COUPON5") {
    addedCredit = 5;
  } else if (coupon === "COUPON10") {
    addedCredit = 10;
  } else if (coupon === "COUPON20") {
    addedCredit = 20;
  }

  if (addedCredit > 0) {
    credit += addedCredit;
    update_credit();
    textbox.value = ''; // clear coupon box
  } else {
    textbox.value = ''; // reset textbox is invalid
  }

  // clear sales message if no items clicked
  let isChecked = false;
  for (let i = 0; i < checkboxes.length; ++i) {
    if (checkboxes[i].checked) {
      isChecked = true;
      break; // stop loop if any checkbox is checked
    }
  }
  if (!isChecked) {
    P2.innerHTML = ''; // clear sales message if no items are checked
  }
}

// COUPON TEXTBOX EVENT LISTENER
const textbox = document.getElementById('textbox');
textbox.addEventListener('keydown', function(event) {
  if (event.key === "Enter") { 
    applyCoupon(); // validate coupon when Enter key is pressed
  }
});