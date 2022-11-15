from django.urls import path
from . import views


urlpatterns = [
    path('',views.index, name = 'index'),
    path('products/<int:id>',views.products, name = 'products'),
    path('products/',views.products, name = 'productall'),
    path('product/<int:id>',views.product, name = 'product'),
    path('cart/',views.cart, name = 'cart'),
    path('checkout/',views.checkout, name = 'checkout'),
    path('order/',views.order,name = 'order'),
    path('ordersingle/',views.ordersingle, name = 'ordersingle'),
    path('success',views.success, name = 'success'),
    
    path('cart_add/<int:pk>',views.cart_add,name = 'cart_add'),
    path('cart_remove/<int:pk>',views.cart_remove,name = 'cart_remove'),
]
