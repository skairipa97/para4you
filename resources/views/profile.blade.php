@extends('layout')

@section('title', 'Mon Profil - Para4You')

@section('page_styles')
<style>
    /* Profile page specific styles */
    .grid-cols-1 {
        display: grid;
        grid-template-columns: 1fr;
    }
    
    @media (min-width: 768px) {
        .grid-cols-1.md\:grid-cols-3 {
            grid-template-columns: 1fr 2fr;
        }
    }
    
    .gap-8 {
        gap: 2rem;
    }
    
    .md\:col-span-1 {
        grid-column: span 1;
    }
    
    .md\:col-span-2 {
        grid-column: span 2;
    }
    
    .rounded-lg {
        border-radius: 0.5rem;
    }
    
    .shadow-md {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    
    .hidden {
        display: none;
    }
</style>
@endsection

@section('content')
<div class="container py-5" data-user-logged-in="{{ session('user_id') ? 'true' : 'false' }}">
    <h1 class="text-3xl fw-bold mb-4">Mon Profil</h1>
    
    <div class="grid-cols-1 md:grid-cols-3 gap-8">
        <!-- User Information -->
        <div class="md:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-4 mb-4">
                <h2 class="h5 fw-semibold mb-4">Informations personnelles</h2>
                
                @if(session('user_id'))
                <div class="mb-4">
                    <div class="mb-2">
                        <span class="fw-medium text-secondary">Nom:</span>
                        <p>{{ session('name') }}</p>
                    </div>
                    <div class="mb-2">
                        <span class="fw-medium text-secondary">Nom d'utilisateur:</span>
                        <p>{{ session('username') }}</p>
                    </div>
                    <div class="mb-2">
                        <span class="fw-medium text-secondary">Email:</span>
                        <p>{{ session('email') }}</p>
                    </div>
                </div>
                
                <div class="mt-4">
                    <button id="edit-profile-btn" class="btn btn-primary w-100">
                        Modifier mon profil
                    </button>
                </div>
                @else
                <div class="text-center py-4">
                    <p class="text-muted mb-3">Vous n'êtes pas connecté</p>
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        Se connecter
                    </a>
                </div>
                @endif
            </div>
            
            <!-- Edit Profile Form (Hidden by default) -->
            <div id="edit-profile-form" class="bg-white rounded-lg shadow-md p-4 mt-4 hidden">
                <h2 class="h5 fw-semibold mb-4">Modifier le profil</h2>
                
                <form action="/update-profile" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ session('name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ session('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Mot de passe actuel</label>
                        <input type="password" id="current_password" name="current_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Nouveau mot de passe (optionnel)</label>
                        <input type="password" id="new_password" name="new_password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="new_password_confirmation" class="form-label">Confirmer le nouveau mot de passe</label>
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control">
                    </div>
                    
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" id="cancel-edit-btn" class="btn btn-secondary">
                            Annuler
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Order History -->
        <div class="md:col-span-2">
            <div class="bg-white rounded-lg shadow-md p-4">
                <h2 class="h5 fw-semibold mb-4">Historique des commandes</h2>
                
                @if(session('user_id'))
                <div id="orders-container">
                    <!-- Orders will be loaded here via AJAX -->
                    <div class="py-4 text-center" id="loading-orders">
                        <p class="text-muted">Chargement de vos commandes...</p>
                    </div>
                    <div id="no-orders" class="py-4 text-center hidden">
                        <p class="text-muted">Vous n'avez pas encore passé de commande</p>
                        <a href="{{ route('produits.index') }}" class="mt-2 d-inline-block text-primary">
                            Découvrir nos produits
                        </a>
                    </div>
                    <div id="orders-list"></div>
                </div>
                @else
                <div class="text-center py-4">
                    <p class="text-muted">Connectez-vous pour voir votre historique de commandes</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle edit profile form
    const editProfileBtn = document.getElementById('edit-profile-btn');
    const editProfileForm = document.getElementById('edit-profile-form');
    const cancelEditBtn = document.getElementById('cancel-edit-btn');
    
    if (editProfileBtn) {
        editProfileBtn.addEventListener('click', function() {
            editProfileForm.classList.remove('hidden');
            editProfileBtn.parentElement.classList.add('hidden');
        });
    }
    
    if (cancelEditBtn) {
        cancelEditBtn.addEventListener('click', function() {
            editProfileForm.classList.add('hidden');
            editProfileBtn.parentElement.classList.remove('hidden');
        });
    }
    
    // Load user orders
    const isLoggedIn = document.querySelector('.container').dataset.userLoggedIn === 'true';
    if (isLoggedIn) {
        loadUserOrders();
    }
    
    function loadUserOrders() {
        // In a real application, you would fetch this data from the server
        // For demonstration, we'll simulate a response with sample data
        setTimeout(() => {
            const ordersData = [
                {
                    id: 'ORD-12345',
                    date: '2023-03-15',
                    status: 'completed',
                    total: 129.99,
                    items: [
                        { name: 'Produit A', quantity: 2, price: 49.99 },
                        { name: 'Produit B', quantity: 1, price: 30.01 }
                    ]
                },
                {
                    id: 'ORD-12346',
                    date: '2023-02-20',
                    status: 'delivered',
                    total: 75.50,
                    items: [
                        { name: 'Produit C', quantity: 1, price: 75.50 }
                    ]
                }
            ];
            
            renderOrders(ordersData);
        }, 1000);
    }
    
    function renderOrders(orders) {
        const loadingElement = document.getElementById('loading-orders');
        const noOrdersElement = document.getElementById('no-orders');
        const ordersListElement = document.getElementById('orders-list');
        
        if (!loadingElement || !noOrdersElement || !ordersListElement) return;
        
        loadingElement.classList.add('hidden');
        
        if (orders.length === 0) {
            noOrdersElement.classList.remove('hidden');
            return;
        }
        
        let ordersHtml = '';
        
        orders.forEach(order => {
            let statusClass = '';
            let statusText = '';
            
            switch (order.status) {
                case 'pending':
                    statusClass = 'bg-warning bg-opacity-25 text-warning';
                    statusText = 'En attente';
                    break;
                case 'processing':
                    statusClass = 'bg-info bg-opacity-25 text-info';
                    statusText = 'En traitement';
                    break;
                case 'completed':
                    statusClass = 'bg-success bg-opacity-25 text-success';
                    statusText = 'Complété';
                    break;
                case 'delivered':
                    statusClass = 'bg-primary bg-opacity-25 text-primary';
                    statusText = 'Livré';
                    break;
                case 'cancelled':
                    statusClass = 'bg-danger bg-opacity-25 text-danger';
                    statusText = 'Annulé';
                    break;
                default:
                    statusClass = 'bg-secondary bg-opacity-25 text-secondary';
                    statusText = order.status;
            }
            
            const date = new Date(order.date);
            const formattedDate = date.toLocaleDateString('fr-FR', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            });
            
            let itemsHtml = '';
            order.items.forEach(item => {
                itemsHtml += `
                    <div class="d-flex justify-content-between py-2 border-top">
                        <div>
                            <span class="fw-medium">${item.name}</span>
                            <span class="text-secondary ms-2">x${item.quantity}</span>
                        </div>
                        <span>${(item.price * item.quantity).toFixed(2)} €</span>
                    </div>
                `;
            });
            
            ordersHtml += `
                <div class="border rounded mb-4 overflow-hidden">
                    <div class="bg-light px-3 py-2 d-flex justify-content-between align-items-center">
                        <div>
                            <span class="fw-medium">${order.id}</span>
                            <span class="text-secondary ms-2">${formattedDate}</span>
                        </div>
                        <span class="badge ${statusClass} rounded-pill">
                            ${statusText}
                        </span>
                    </div>
                    <div class="p-3">
                        ${itemsHtml}
                        <div class="d-flex justify-content-between py-2 border-top fw-bold mt-2">
                            <span>Total</span>
                            <span>${order.total.toFixed(2)} €</span>
                        </div>
                    </div>
                </div>
            `;
        });
        
        ordersListElement.innerHTML = ordersHtml;
    }
});
</script>
@endsection 