from django.shortcuts import render,get_object_or_404,redirect
from .models import Category,Product,Order,OrderItem
from .forms import OrderForms
from .cart import Cart

# Create your views here.

def index(request):
    # cart = Cart(request)
    # cart.clear()
    pro = Product.objects.all()
    context = { 'pros' : pro }
    return render(request,'main/index.html',context)

def products(request, id=None):
    if id:
        cate = get_object_or_404(Category,id=id)
        pro = Product.objects.filter( cat = cate )
        context = { 'pros' : pro}
        return render(request,'main/products.html',context)
    else:
        pro = Product.objects.all()
        context = { 'pros' : pro }
        return render(request,'main/products.html',context)

def product(request,id):
    pro = Product.objects.get(id = id)
    context = { 'pros' : pro }
    
    return render(request,'main/productsingle.html',context)

def cart(request):
    
    cart = Cart(request)
    context = {'cart':cart}
    for item in cart:
        print(item)
    return render(request,'main/cart.html',context)

def checkout(request):
    cart = Cart(request)
    print('checkout me')
    if request.method == "POST":
        form = OrderForms(request.POST)
        print('posted me')
        if form.is_valid():
            order = form.save()
            print('saved me')
            for item in cart:
                OrderItem.objects.create(
                    order = order,
                    product = item['product'],
                    quantity = item['quantity']
                )
            cart.clear()
            return redirect('success')
        
    form = OrderForms()    
    context = {
        'form':form,
        'cart':cart,
    }
    return render(request,'main/Checkout.html',context)

def order(request):
    orders = Order.objects.all()
    context = {
        'orders' : orders,
    }
    return render(request,'main/order.html',context)

def ordersingle(request,pk):
    orders = Order.objects.get(pk = pk) 
    items = OrderItem.objects.filter(order = orders)
    context = {
        'items' : item,
    }
    return render(request,'main/ordersingle.html',context)

def success(request):
    return render(request,'main/success.html')

def cart_add(request,pk):
    product = Product.objects.get(id = pk)
    price = product.pro_price
    cart = Cart(request)
    cart.add(pk,price)
    return redirect('cart')

def cart_remove(request,pk):
    cart = Cart(request)
    cart.remove(pk)
    return redirect('cart')