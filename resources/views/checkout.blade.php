@extends('layout')

@section('content')
<div class="container mx-auto py-8 px-4">
    <h1 class="text-3xl font-bold mb-6">Finaliser votre commande</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Order Summary -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Résumé de votre commande</h2>
            
            <div id="checkout-items" class="mb-6">
                <!-- Items will be loaded here via JavaScript -->
            </div>
            
            <div class="border-t pt-4">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-700">Sous-total:</span>
                    <span class="font-semibold" id="checkout-subtotal">0,00 €</span>
                </div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-700">TVA (20%):</span>
                    <span class="font-semibold" id="checkout-tax">0,00 €</span>
                </div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-700">Frais de livraison:</span>
                    <span class="font-semibold" id="checkout-shipping">5,00 €</span>
                </div>
                <div class="flex justify-between items-center pt-2 border-t text-lg">
                    <span class="font-bold">Total:</span>
                    <span class="font-bold" id="checkout-total">0,00 €</span>
                </div>
            </div>
        </div>
        
        <!-- Customer Information -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Informations de livraison</h2>
            
            <form id="checkout-form" action="{{ route('orders.store') }}" method="POST">
                @csrf
                <input type="hidden" name="order_items" id="order-items-input">
                <input type="hidden" name="order_total" id="order-total-input">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="first_name" class="block text-gray-700 mb-1">Prénom</label>
                        <input type="text" id="first_name" name="first_name" class="w-full p-2 border rounded-lg" required>
                    </div>
                    <div>
                        <label for="last_name" class="block text-gray-700 mb-1">Nom</label>
                        <input type="text" id="last_name" name="last_name" class="w-full p-2 border rounded-lg" required>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" class="w-full p-2 border rounded-lg" required>
                </div>
                
                <div class="mb-4">
                    <label for="address" class="block text-gray-700 mb-1">Adresse</label>
                    <input type="text" id="address" name="address" class="w-full p-2 border rounded-lg" required>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="postal_code" class="block text-gray-700 mb-1">Code postal</label>
                        <input type="text" id="postal_code" name="postal_code" class="w-full p-2 border rounded-lg" required>
                    </div>
                    <div>
                        <label for="city" class="block text-gray-700 mb-1">Ville</label>
                        <input type="text" id="city" name="city" class="w-full p-2 border rounded-lg" required>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 mb-1">Téléphone</label>
                    <input type="tel" id="phone" name="phone" class="w-full p-2 border rounded-lg" required>
                </div>
                
                <h2 class="text-xl font-semibold mb-4 mt-8">Méthode de paiement</h2>
                
                <div class="mb-4">
                    <div class="flex items-center mb-2">
                        <input type="radio" id="payment_card" name="payment_method" value="card" class="mr-2" checked>
                        <label for="payment_card" class="text-gray-700">Carte de crédit</label>
                    </div>
                    
                    <div id="card-payment-details" class="bg-gray-50 p-4 rounded-lg">
                        <div class="mb-4">
                            <label for="card_number" class="block text-gray-700 mb-1">Numéro de carte</label>
                            <input type="text" id="card_number" name="card_number" class="w-full p-2 border rounded-lg" placeholder="1234 5678 9012 3456" required>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="expiry_date" class="block text-gray-700 mb-1">Date d'expiration</label>
                                <input type="text" id="expiry_date" name="expiry_date" class="w-full p-2 border rounded-lg" placeholder="MM/AA" required>
                            </div>
                            <div>
                                <label for="cvv" class="block text-gray-700 mb-1">CVV</label>
                                <input type="text" id="cvv" name="cvv" class="w-full p-2 border rounded-lg" placeholder="123" required>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <div class="flex items-center">
                        <input type="radio" id="payment_paypal" name="payment_method" value="paypal" class="mr-2">
                        <label for="payment_paypal" class="text-gray-700">PayPal</label>
                    </div>
                </div>
                
                <div class="mt-6">
                    <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-lg font-medium hover:bg-green-700 transition duration-200">
                        Confirmer la commande
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Load cart items from localStorage
    const cartItems = JSON.parse(localStorage.getItem('cart')) || [];
    const checkoutItemsContainer = document.getElementById('checkout-items');
    
    // If cart is empty, redirect to cart page
    if (cartItems.length === 0) {
        window.location.href = "{{ route('produits.index') }}";
    }
    
    // Display cart items in checkout
    let subtotal = 0;
    let itemsHtml = '';
    
    cartItems.forEach(item => {
        const itemTotal = item.price * item.quantity;
        subtotal += itemTotal;
        
        itemsHtml += `
            <div class="flex justify-between items-center mb-3">
                <div class="flex items-center">
                    <img src="${item.image}" alt="${item.name}" class="w-12 h-12 object-cover mr-3">
                    <div>
                        <h3 class="font-medium">${item.name}</h3>
                        <p class="text-gray-600 text-sm">${item.price.toFixed(2)} € x ${item.quantity}</p>
                    </div>
                </div>
                <p class="font-medium">${itemTotal.toFixed(2)} €</p>
            </div>
        `;
    });
    
    checkoutItemsContainer.innerHTML = itemsHtml;
    
    // Calculate totals
    const shipping = 5.00;
    const tax = subtotal * 0.2;
    const total = subtotal + tax + shipping;
    
    document.getElementById('checkout-subtotal').textContent = subtotal.toFixed(2) + ' €';
    document.getElementById('checkout-tax').textContent = tax.toFixed(2) + ' €';
    document.getElementById('checkout-shipping').textContent = shipping.toFixed(2) + ' €';
    document.getElementById('checkout-total').textContent = total.toFixed(2) + ' €';
    
    // Set hidden form inputs
    document.getElementById('order-items-input').value = JSON.stringify(cartItems);
    document.getElementById('order-total-input').value = total;
    
    // Toggle payment method details
    const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
    const cardPaymentDetails = document.getElementById('card-payment-details');
    
    paymentMethods.forEach(method => {
        method.addEventListener('change', function() {
            if (this.value === 'card') {
                cardPaymentDetails.classList.remove('hidden');
                document.getElementById('card_number').setAttribute('required', 'required');
                document.getElementById('expiry_date').setAttribute('required', 'required');
                document.getElementById('cvv').setAttribute('required', 'required');
            } else {
                cardPaymentDetails.classList.add('hidden');
                document.getElementById('card_number').removeAttribute('required');
                document.getElementById('expiry_date').removeAttribute('required');
                document.getElementById('cvv').removeAttribute('required');
            }
        });
    });
    
    // Handle form submission
    document.getElementById('checkout-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Here you would normally validate the form and process the payment
        // For demonstration, we'll just simulate a successful order
        
        // Clear the cart after successful order
        localStorage.removeItem('cart');
        
        // Submit the form
        this.submit();
    });
});
</script>
@endsection 