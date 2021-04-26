from django.shortcuts import render
from django.http import HttpResponse, HttpResponseRedirect
from mainApp.models import Tent
from mainApp.forms import TentForm

# Create your views here.

# ������� ����� ������� ��������
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
    return render(request, "mainApp/productedit.html", {'form' : form})


# �������������� �������� ��������
def edittent(request, tentNumber):

    # �������� �� ���������� ����� �������
    tent = Tent.objects.get(PK_Tent = tentNumber)

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

    #�������� ����� � ����������� ����� ������� ������
    form = TentForm(instance=tent)
    return render(request, "mainApp/productedit.html", {'form' : form, 'pk' : tent.PK_Tent})


# ������� ��������
def index(request):
	return render(request, 'mainApp/index.html')

# �������
def catalog(request):
	tents = Tent.objects.all()
	return render(request, 'mainApp/catalog.html', {"tents" : tents})

# ����������������� ��������
def pageadmin(request):
	tents = Tent.objects.all() 
	return render(request, 'mainApp/pageadmin.html', {"tents" : tents})

# ��������� ���������� �� �������� ��������
def productinfo(request, tentNumber):
    singleTent = Tent.objects.get(PK_Tent=tentNumber)
    return render(request, "mainApp/productinfo.html", {"singleTent" : singleTent})

# �������� �������� ��������
def deletetent(request, tentNumber):
    currentTent = Tent.objects.get(PK_Tent=tentNumber)
    currentTent.delete()
    return HttpResponseRedirect('/pageadmin')
