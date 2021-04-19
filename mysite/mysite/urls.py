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
from mainApp import views
from mysite import settings
from django.conf.urls.static import static

urlpatterns = [


    # ������� ����� ������� ��������
    path('createtent/', views.createtent, name="createtent"),

    # �������������� �������� ��������
    path('edittent/<int:tentNumber>/', views.edittent, name="edittent"),
        
    # ������� ������� ��������
    path('deletetent_<int:tentNumber>/', views.deletetent, name="deletetent"),

     #������� ��������
    path('', views.index, name="index"),
    path('index/', views.index, name="index1"),

    # �������
    path(r'catalog/', views.catalog, name="catalog"),
    
    # ������������������� ��������
    path('pageadmin/', views.pageadmin, name="pageadmin"),

    # ��������� ���������� �� �������� ��������
    path('productinfo_<int:tentNumber>/', views.productinfo, name="productinfo"),

    path('admin/', admin.site.urls),


    path('lk/', views.lk, name='lk'),
    path('login', views.login_view, name='login'),
    path('registration/', views.registration_view, name='registration'),
    path('logout/', views.logout_view, name='logout')
] + static(settings.MEDIA_URL, document_root=settings.MEDIA_ROOT)

handler404 = 'mainApp.views.error_404_view'