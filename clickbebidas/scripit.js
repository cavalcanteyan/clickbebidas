
document.getElementById('toggle-cart').addEventListener('click', () => {
    const cart = document.getElementById('cart');
    // Alterna a visibilidade do carrinho
    if (cart.style.display === 'none' || cart.style.display === '') {
        cart.style.display = 'block'; // Mostra o carrinho
    } else {
        cart.style.display = 'none'; // Esconde o carrinho
    }
});
