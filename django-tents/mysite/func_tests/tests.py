from selenium import webdriver
from mainApp.models import Tent, Category, Brand
from django.contrib.staticfiles.testing import StaticLiveServerTestCase


class Test_1(StaticLiveServerTestCase):

    def setUp(self):
        self.browser = webdriver.Chrome('func_tests/yandexdriver.exe')
        self.browser.set_window_size(1600, 2000)

    def tearDown(self):
        self.browser.close()

    def create_categories_brands(self):
        newBrand = Brand()
        newBrand.name = "Higashi"
        newBrand.save()

        newBrand = Brand()
        newBrand.name = "Tramp"
        newBrand.save()

        newCategory = Category()
        newCategory.name = "Зима"
        newCategory.save()

        newCategory = Category()
        newCategory.name = "Лето"
        newCategory.save()

    def create_tent(self):
        newTent = Tent()
        newTent.name = "Какая-то рандомная палатка"
        newTent.places = 2
        newTent.doors = 1
        newTent.windows = 3
        newTent.weight = 5
        newTent.PK_Brand = Brand.objects.get(PK_Brand=2)
        newTent.PK_Category = Category.objects.get(PK_Category=2)
        newTent.price = 12345.00
        newTent.save()

    # тест на добавление палатки
    def test_add(self):
        self.create_categories_brands()
        self.create_tent()

        amount_before = Tent.objects.all().count()              # посчитать все палатки бд
        print('Кол-во палаток до: ', amount_before)

        self.browser.get(self.live_server_url + '/createtent/') # открыть страницу добавления новой палатки
        #time.sleep(delay * 3)                                     # ждем загрузку страницы

        # заполнить форму
        self.browser.find_element_by_xpath('//*[@id="id_name"]').send_keys('Какая-то палатка')
        self.browser.find_element_by_xpath('//*[@id="id_price"]').send_keys('99999')
        self.browser.find_element_by_xpath('//*[@id="id_weight"]').send_keys('5')
        self.browser.find_element_by_xpath('//*[@id="id_places"]').send_keys('2')
        self.browser.find_element_by_xpath('//*[@id="id_doors"]').send_keys('1')
        self.browser.find_element_by_xpath('//*[@id="id_windows"]').send_keys('3')

        # кликнуть кнопку добавления палатки на страничке
        self.browser.find_element_by_xpath('/html/body/main/div/form/div/button[2]').click()

        # посчитать все палатки в бд
        amount_after = Tent.objects.all().count()

        print('Кол-во палаток после: ', amount_after)

        self.assertEquals(amount_before + 1, amount_after)  # убедиться, что в бд добавилась палатка
