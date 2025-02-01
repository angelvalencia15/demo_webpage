const button = document.getElementById("loginButton");
let counter = 0;

button.addEventListener("click", function () {
  ++counter;
  const heading = document.getElementsByTagName("h1")[0];

  if (counter === 1) {
    heading.innerHTML = "HA";
  } else {
    heading.innerHTML += "HA";
  }
  mockPassword();
});

const passwordbox = document.getElementById("passwordbox");

passwordbox.addEventListener("keydown", function (event) {
  if (event.key === "Enter") {
    ++counter;
    const heading = document.getElementsByTagName("h1")[0];
   
    if (counter === 1) {
      heading.innerHTML = "HA";
    } else {
      heading.innerHTML += "HA";
    }
    mockPassword();
  }
});

function mockPassword() {
  const password = passwordbox.value;
  const newMocking = document.createElement("p");
  newMocking.innerHTML = `Somebody knows the password you like to use is <b>${password}</b>.`;
  const section = document.getElementsByTagName("section")[0];
  section.appendChild(newMocking);
}