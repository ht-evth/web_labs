from django.shortcuts import render, redirect
from django.http import HttpResponse, HttpResponseRedirect, JsonResponse
from mainApp.models import Tent, Brand, Category
from mainApp.forms import TentForm, UserLoginForm, UserRegistrationForm, AccountDataForm

from django.contrib.auth import authenticate, login, logout
from django.contrib.auth.decorators import login_required

# Create your views here.

# ������� ����� ������� ��������


@login_required
def createtent(request):
    # �������� ����� � ���������� �����������
    if request.method == 'POST':
        form = TentForm(request.POST, request.FILES)

        # ��������� � �� � ������������ ������� �� �������� �����������������
        if form.is_valid():
            newTent = form.save(commit=False)
            newTent.save()
            return HttpResponseRedirect('/pageadmin')

    # ������ �����
    form = TentForm()
    return render(request, "mainApp/productedit.html", {'form': form})


# �������������� �������� ��������
@login_required
def edittent(request, tentNumber):

    # �������� �� ���������� ����� �������
    tent = Tent.objects.get(PK_Tent=tentNumber)

    if request.method == 'POST':
        # �������� ����� � ���������� �����������
        form = TentForm(request.POST, request.FILES)

        # ���� ����� ��������� ���������
        if form.is_valid():

            # ���������� � ����
            tent.PK_Brand = form.cleaned_data["PK_Brand"]
            tent.name = form.cleaned_data["name"]
            tent.PK_Category = form.cleaned_data["PK_Category"]
            tent.price = form.cleaned_data["price"]
            tent.weight = form.cleaned_data["weight"]
            tent.places = form.cleaned_data["places"]
            tent.doors = form.cleaned_data["doors"]
            tent.windows = form.cleaned_data["windows"]
            tent.description = form.cleaned_data["description"]
            tent.imagepath = form.cleaned_data["imagepath"]

            # ���������
            tent.save()
            return HttpResponseRedirect('/pageadmin')

    # �������� ����� � ����������� ����� ������� ������
    form = TentForm(instance=tent)
    return render(request, "mainApp/productedit.html", {'form': form, 'pk': tent.PK_Tent})


# ������� ��������
def index(request):
    return render(request, 'mainApp/index.html')

# �������


def catalog(request):
    tents = Tent.objects.all()


    if request.is_ajax():
        tents_data = []
        for tent in tents:

            imgpath = ""
            if tent.imagepath:
                imgpath = tent.imagepath.url

            print(tent.PK_Category)

            tents_data.append({
                'PK_Tent': tent.PK_Tent,
                'name': tent.name,
                'price': tent.price,
                'imagepath': imgpath,
                'PK_Category': tent.PK_Category.PK_Category,
                'category': tent.PK_Category.name,
                'PK_Brand': tent.PK_Brand.PK_Brand,
                'brand': tent.PK_Brand.name,
                'places': tent.places,
                'weight': tent.weight,
                'doors': tent.doors,
                'windows': tent.windows,
                'get_url': tent.get_url()
            })
        return JsonResponse(tents_data, safe=False)

    return render(request, 'mainApp/catalog.html', {
        "tents": tents,
        "brands": Brand.objects.all(),
        "categories": Category.objects.all()
        })

# ����������������� ��������


@login_required
def pageadmin(request):

    if request.user.is_staff:
        tents = Tent.objects.all()
        return render(request, 'mainApp/pageadmin.html', {"tents": tents})
    return render(request, 'mainApp/404.html')


def error_404_view(request, exception):
    return render(request, 'mainApp/404.html')

# ��������� ���������� �� �������� ��������


def productinfo(request, tentNumber):
    singleTent = Tent.objects.get(PK_Tent=tentNumber)
    return render(request, "mainApp/productinfo.html", {"singleTent": singleTent})

# �������� �������� ��������


@login_required
def deletetent(request, tentNumber):
    currentTent = Tent.objects.get(PK_Tent=tentNumber)
    currentTent.delete()
    return HttpResponseRedirect('/pageadmin')


@login_required
def lk(request):
    visitor = request.user.profile

    if request.method == 'GET':

        form = AccountDataForm(initial={
            'name': visitor.name,
            'midname': visitor.midname,
            'surname': visitor.surname,
            'email': visitor.email
        })
        return render(request, 'mainApp/lk.html', {'form': form})
    elif request.method == 'POST':

        form = AccountDataForm(request.POST)
        if form.is_valid():

            visitor.name = form.cleaned_data['name']
            visitor.midname = form.cleaned_data['midname']
            visitor.surname = form.cleaned_data['surname']
            visitor.email = form.cleaned_data['email']

            visitor.save()

            return redirect('lk')

        return redirect('lk')
    


def login_view(request):
    if request.method == 'GET':
        if request.user.is_authenticated:
            return redirect('index')
        return render(request, 'mainApp/login.html', {'form': UserLoginForm(), 'titlePage': 'Вход', 'titleButton': 'Войти'})

    elif request.method == 'POST':
        user = authenticate(
            request, username=request.POST['username'], password=request.POST['password'])

        if user is None:
            return render(request, 'mainApp/login.html', {'form': UserLoginForm(), 'error': 'Логин и/или пароль не подходят...', 'titlePage': 'Вход', 'titleButton': 'Войти'})
        else:
            login(request, user)
            return redirect('lk')


def registration_view(request):
    if request.method == 'GET':
        if request.user.is_authenticated:
            return redirect('index')
        return render(request, 'mainApp/login.html', {'form': UserRegistrationForm(), 'titlePage': 'Регистрация', 'titleButton': 'Зарегистрироваться'})

    elif request.method == 'POST':
        form = UserRegistrationForm(request.POST)

        if form.is_valid():
            form.save()

            username = form.cleaned_data.get('username')
            raw_password = form.cleaned_data.get('password1')
            user = authenticate(username=username, password=raw_password)

            if user is None:
                return render(request, 'mainApp/login.html', {'form': UserRegistrationForm(), 'error': 'Ошибка регистрации...', 'titlePage': 'Регистрация', 'titleButton': 'Зарегистрироваться'})
            else:
                user.profile.name = form.cleaned_data.get('name')
                user.profile.email = form.cleaned_data.get('email')
                login(request, user)
                return redirect('lk')

    return redirect('index')


@login_required
def logout_view(request):
    logout(request)
    return redirect('index')
