from django import forms
from .models import Tent, Category, Brand
from django.forms.widgets import ClearableFileInput

class MyClearableFileInput(ClearableFileInput):
    initial_text = 'Выбрано'
    input_text = 'Изменить'
    clear_checkbox_label = 'Удалить'

class TentForm(forms.ModelForm):

    PK_Brand = forms.ModelChoiceField(queryset = Brand.objects.all(), empty_label=None, label="Бренд")
    PK_Brand.widget.attrs.update({'class' : 'form-control'})
        
    name = forms.CharField(label="Название")
    name.widget.attrs.update({'class' : 'form-control'})

    PK_Category = forms.ModelChoiceField(queryset = Category.objects.all(), empty_label=None, label="Категория")
    PK_Category.widget.attrs.update({'class' : 'form-control'})

    price = forms.DecimalField(decimal_places = 2, label = "Цена")
    price.widget.attrs.update({'class' : 'form-control'})

    weight = forms.DecimalField(label="Вес")
    weight.widget.attrs.update({'class' : 'form-control'})

    places = forms.IntegerField(label="Кол-во мест")
    places.widget.attrs.update({'class' : 'form-control'})

    doors = forms.IntegerField(label="Кол-во дверей")
    doors.widget.attrs.update({'class' : 'form-control'})

    windows = forms.IntegerField(label="Кол-во окон")
    windows.widget.attrs.update({'class' : 'form-control'})

    imagepath = forms.ImageField(label = "Изображение", required=False, widget=MyClearableFileInput)
    imagepath.widget.attrs.update({'class' : 'form-control'})

    description = forms.CharField(label="Описание", widget=forms.Textarea, required=False)
    description.widget.attrs.update({'class' : 'form-control'})

    class Meta:
        model = Tent
        fields = ['PK_Brand', 'name', 'PK_Category', 'price', 'weight', 'places', 'doors', 'windows', 'imagepath', 'description']


