from selenium import webdriver
from mainApp.models import Tent
from django.contrib.staticfiles.testing import StaticLiveServerTestCase
from django.urls import reverse

class Test_1(StaticLiveServerTestCase):

    def test_foo(self):
        self.assertEquals(0, 1)