@extends('layout')

@section('content')
<div class="container mx-auto py-8 px-4">
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center bg-green-100 rounded-full p-4 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <h1 class="text-3xl font-bold mb-2">Commande confirmée !</h1>
        <p class="text-xl text-gray-600">Merci pour votre achat.</p>
    </div>
    
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Détails de la commande</h2>
                <span class="text-gray-600">Commande #{{ $order->order_number }}</span>
            </div>
            
            <div class="border-t pt-4">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-700">Date:</span>
                    <span>{{ $order->created_at->format('d/m/Y') }}</span>
                </div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-700">Nom:</span>
                    <span>{{ $order->first_name }} {{ $order->last_name }}</span>
                </div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-700">Email:</span>
                    <span>{{ $order->email }}</span>
                </div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-700">Adresse:</span>
                    <span>{{ $order->address }}, {{ $order->postal_code }} {{ $order->city }}</span>
                </div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-700">Méthode de paiement:</span>
                    <span>{{ $order->payment_method === 'card' ? 'Carte de crédit' : 'PayPal' }}</span>
                </div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-700">Statut:</span>
                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        En attente
                    </span>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Articles commandés</h2>
            
            <div class="space-y-4">
                @foreach($orderItems as $item)
                <div class="flex justify-between items-center py-2 border-b">
                    <div class="flex items-center">
                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-16 h-16 object-cover mr-4">
                        <div>
                            <h3 class="font-medium">{{ $item['name'] }}</h3>
                            <p class="text-gray-600">{{ number_format($item['price'], 2) }} € x {{ $item['quantity'] }}</p>
                        </div>
                    </div>
                    <p class="font-medium">{{ number_format($item['price'] * $item['quantity'], 2) }} €</p>
                </div>
                @endforeach
            </div>
            
            <div class="mt-4 border-t pt-4">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-700">Sous-total:</span>
                    <span>{{ number_format($order->total_amount - ($order->total_amount * 0.2) - 5.00, 2) }} €</span>
                </div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-700">TVA (20%):</span>
                    <span>{{ number_format($order->total_amount * 0.2, 2) }} €</span>
                </div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-700">Frais de livraison:</span>
                    <span>5,00 €</span>
                </div>
                <div class="flex justify-between items-center pt-2 border-t text-lg font-bold">
                    <span>Total:</span>
                    <span>{{ number_format($order->total_amount, 2) }} €</span>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-8">
            <p class="text-gray-600 mb-4">Un e-mail de confirmation a été envoyé à {{ $order->email }}</p>
            <a href="{{ route('produits.index') }}" class="bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700 transition duration-200">Continuer vos achats</a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Clear the cart from localStorage after successful order
    localStorage.removeItem('cart');
});
</script>
@endsection 