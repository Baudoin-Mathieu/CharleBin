describe('template spec', () => {
  it('passes', () => {
    cy.visit('http://localhost:8080');

    let message = "abcde12345";
    let motDePasse = "password123@";
    let messageRecu ;

    cy.get("textarea#message").type(message);
    cy.get("input#passwordinput").type(motDePasse);
    cy.get("button#sendbutton").click();

    cy.get("a#pasteurl").click();

    cy.get("input#passworddecrypt").type(motDePasse);
    cy.get("button[type=submit]").click();

    cy.get("pre#prettyprint").then(($div) => {
      messageRecu = $div.text();
    });

    cy.then(() => {
      expect(messageRecu).equal(message);
    })
    
  })
})