"""mysite URL Configuration

The `urlpatterns` list routes URLs to views. For more information please see:
    https://docs.djangoproject.com/en/3.1/topics/http/urls/
Examples:
Function views
    1. Add an import:  from my_app import views
    2. Add a URL to urlpatterns:  path('', views.home, name='home')
Class-based views
    1. Add an import:  from other_app.views import Home
    2. Add a URL to urlpatterns:  path('', Home.as_view(), name='home')
Including another URLconf
    1. Import the include() function: from django.urls import include, path
    2. Add a URL to urlpatterns:  path('blog/', include('blog.urls'))
"""
from django.contrib import admin
from django.urls import path, include
from . import views

urlpatterns = [

    #$path('', include('mainApp.urls')),

     #главная страница
    path('', views.index, name="index"),
    path('index/', views.index, name="index1"),

    #каталог для пользователя
    path('catalog/', views.catalog, name="catalog"),

    
    #каталог для админа ( с удалением, добавлением, редактированием )
    path('pageadmin/', views.pageadmin, name="pageadmin"),

    #подробности палатки с номером tentNumber
    path('productinfo_<int:tentNumber>/', views.productinfo, name="productinfo"),

    #удаление палатки с номером tentNumber
    path('deletetent_<int:tentNumber>/', views.deletetent, name="deletetent"),

    #создание нового продукта
    path('createtent/', views.createtent, name="createtent"),

    #редактирование палатки с номером tentNumber
    path('edittent/<int:tentNumber>/', views.edittent, name="edittent"),


    # админ страница сайта (стандартная для джанго)
    path('admin', admin.site.urls),

]
