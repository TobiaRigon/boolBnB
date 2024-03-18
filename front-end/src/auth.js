// auth.js
export function isAuthenticated() {
   
    // Controlla se l'utente è LOGGATO e salva il suo stato 
    return localStorage.getItem('loggedIn') === 'true';
}

export function login() {

    // Effettua la funzione e salva lo stato in localStorage
    localStorage.setItem('loggedIn', 'true');
}

export function logout() {

    // Effetta il logout e rimuovi lo stato da localStorage
    localStorage.removeItem('loggedIn');
}
  