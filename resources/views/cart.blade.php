@extends('layout')

@section('content')
<div class="container mx-auto py-8 px-4">
    <h1 class="text-3xl font-bold mb-6">Votre Panier</h1>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <div id="cart-items" class="mb-8">
            <!-- Cart items will be loaded here via JavaScript -->
            <div class="empty-cart-message hidden text-center py-8">
                <p class="text-gray-500 text-xl">Votre panier est vide</p>
                <a href="{{ route('produits.index') }}" class="mt-4 inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">Continuer vos achats</a>
            </div>
            
            <div class="cart-items-list">
                <!-- Template for cart items -->
                <div id="cart-items-container"></div>
            </div>
        </div>
        
        <div class="cart-summary border-t pt-4">
            <div class="flex justify-between items-center mb-4">
                <span class="text-gray-700">Sous-total:</span>
                <span class="font-semibold" id="cart-subtotal">0,00 €</span>
            </div>
            <div class="flex justify-between items-center mb-4">
                <span class="text-gray-700">TVA (20%):</span>
                <span class="font-semibold" id="cart-tax">0,00 €</span>
            </div>
            <div class="flex justify-between items-center mb-4 text-lg">
                <span class="font-bold">Total:</span>
                <span class="font-bold" id="cart-total">0,00 €</span>
            </div>
            
            <div class="flex justify-between mt-6">
                <a href="{{ route('produits.index') }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300 transition duration-200">Continuer vos achats</a>
                <a href="{{ route('checkout') }}" id="checkout-btn" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition duration-200 disabled:opacity-50 disabled:cursor-not-allowed">Passer à la caisse</a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Load cart from localStorage
    loadCart();
    
    // Update cart when items are added/removed
    function loadCart() {
        const cartItems = JSON.parse(localStorage.getItem('cart')) || [];
        const cartContainer = document.getElementById('cart-items-container');
        const emptyCartMessage = document.querySelector('.empty-cart-message');
        const checkoutBtn = document.getElementById('checkout-btn');
        
        // Show/hide empty cart message
        if (cartItems.length === 0) {
            emptyCartMessage.classList.remove('hidden');
            checkoutBtn.classList.add('opacity-50', 'cursor-not-allowed');
            checkoutBtn.setAttribute('disabled', 'disabled');
        } else {
            emptyCartMessage.classList.add('hidden');
            checkoutBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            checkoutBtn.removeAttribute('disabled');
        }
        
        // Clear previous items
        cartContainer.innerHTML = '';
        
        // Calculate totals
        let subtotal = 0;
        
        // Add each item to the cart
        cartItems.forEach((item, index) => {
            const itemTotal = item.price * item.quantity;
            subtotal += itemTotal;
            
            const cartItemEl = document.createElement('div');
            cartItemEl.className = 'flex items-center justify-between border-b py-4';
            cartItemEl.innerHTML = `
                <div class="flex items-center">
                    <img src="${item.image}" alt="${item.name}" class="w-16 h-16 object-cover mr-4">
                    <div>
                        <h3 class="font-medium">${item.name}</h3>
                        <p class="text-gray-600">${item.price.toFixed(2)} € x ${item.quantity}</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center mr-4">
                        <button class="decrement-qty bg-gray-200 px-2 py-1 rounded-l" data-index="${index}">-</button>
                        <span class="px-4 py-1 border-t border-b">${item.quantity}</span>
                        <button class="increment-qty bg-gray-200 px-2 py-1 rounded-r" data-index="${index}">+</button>
                    </div>
                    <p class="font-medium mr-4">${(itemTotal).toFixed(2)} €</p>
                    <button class="remove-item text-red-600" data-index="${index}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            `;
            
            cartContainer.appendChild(cartItemEl);
        });
        
        // Update totals
        const tax = subtotal * 0.2;
        const total = subtotal + tax;
        
        document.getElementById('cart-subtotal').textContent = subtotal.toFixed(2) + ' €';
        document.getElementById('cart-tax').textContent = tax.toFixed(2) + ' €';
        document.getElementById('cart-total').textContent = total.toFixed(2) + ' €';
        
        // Add event listeners for quantity buttons and remove buttons
        document.querySelectorAll('.increment-qty').forEach(btn => {
            btn.addEventListener('click', function() {
                incrementQuantity(parseInt(this.dataset.index));
            });
        });
        
        document.querySelectorAll('.decrement-qty').forEach(btn => {
            btn.addEventListener('click', function() {
                decrementQuantity(parseInt(this.dataset.index));
            });
        });
        
        document.querySelectorAll('.remove-item').forEach(btn => {
            btn.addEventListener('click', function() {
                removeItem(parseInt(this.dataset.index));
            });
        });
    }
    
    // Increment item quantity
    function incrementQuantity(index) {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        cart[index].quantity++;
        localStorage.setItem('cart', JSON.stringify(cart));
        loadCart();
    }
    
    // Decrement item quantity
    function decrementQuantity(index) {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        if (cart[index].quantity > 1) {
            cart[index].quantity--;
            localStorage.setItem('cart', JSON.stringify(cart));
            loadCart();
        }
    }
    
    // Remove item from cart
    function removeItem(index) {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        cart.splice(index, 1);
        localStorage.setItem('cart', JSON.stringify(cart));
        loadCart();
    }
});
</script>
@endsection 