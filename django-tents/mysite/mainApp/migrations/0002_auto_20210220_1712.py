# Generated by Django 3.1.7 on 2021-02-20 10:12

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('mainApp', '0001_initial'),
    ]

    operations = [
        migrations.AlterField(
            model_name='tent',
            name='weight',
            field=models.DecimalField(db_column='weight', decimal_places=2, max_digits=5),
        ),
    ]
