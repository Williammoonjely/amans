from django.db import models
# Create your models here.
class Category(models.Model):
    cat_name = models.CharField(max_length=80)
    cat_image = models.ImageField(upload_to = 'cat')
    
    def __str__(self):
        return self.cat_name
     
class Product(models.Model):
    pro_name = models.CharField(max_length=80)
    pro_price = models.IntegerField()
    pro_spec = models.CharField(max_length=30)
    pro_qty = models.IntegerField()
    pro_image = models.ImageField(upload_to = 'pro')
    
    cat_key = models.ForeignKey('Category',on_delete = models.CASCADE)
    
    def __str__(self):
        return self.pro_name
    
    
class Order(models.Model):
    cust_name = models.CharField(max_length=50)
    email = models.CharField(max_length=100)
    phone = models.CharField(max_length=20)
    
class OrderItem(models.Model):
    order = models.ForeignKey(Order, on_delete=models.CASCADE)
    product = models.ForeignKey(Product, on_delete=models.CASCADE)
    quantity = models.CharField(max_length=5)
    