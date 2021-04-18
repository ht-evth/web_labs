from django.db import models
from django.urls import reverse


class Brand(models.Model):
    PK_Brand = models.AutoField(db_column='PK_Brand', primary_key=True) 
    name = models.CharField(db_column='nameBrand', max_length=100)

    class Meta:
        db_table = 'Brand'

    def __str__(self):
        return self.name

        
class Category(models.Model):
    PK_Category = models.AutoField(db_column='PK_Category', primary_key=True) 
    name = models.CharField(db_column='nameCategory', max_length=100)

    class Meta:
        db_table = 'Category'

    def __str__(self):
        return self.name



class Tent(models.Model):
    PK_Tent = models.AutoField(db_column='PK_Tent', primary_key=True)
    name = models.CharField(db_column='nameTent', max_length=200)
    price = models.DecimalField(db_column='price', max_digits=15, decimal_places=2)
    weight = models.DecimalField(db_column='weight', max_digits=5, decimal_places=2)
    places = models.IntegerField(db_column='places')
    doors = models.IntegerField(db_column='doors')
    windows = models.IntegerField(db_column='windows')
    description = models.TextField(db_column='description', blank=True, null=True)
    imagepath = models.ImageField(db_column='imagePath', max_length=255, blank=True, null=True)
    PK_Category = models.ForeignKey(Category, models.DO_NOTHING, db_column='PK_Category')
    PK_Brand = models.ForeignKey(Brand, models.DO_NOTHING, db_column='PK_Brand')

    def get_url(self):
        return reverse('productinfo',args=[str(self.PK_Tent)])

    class Meta:
        db_table = 'Tent'


