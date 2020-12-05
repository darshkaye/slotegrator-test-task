<p align="center">
    <h1 align="center">Slotegrator Test Task</h1>
    <br>
</p>

Task for generating random prizes.

The template contains the basic features including user login/logout and a generating page.
It includes all commonly used configurations that would allow you to focus on adding new
features to your application.

Before using test version of task create user `admin/admin` for your database.
1. Login - [/site/login](/#)
2. Logout - [/site/logout](/#)
3. Main page with the button 'Get prize' generates random prize (money, loyalty, box)
4. After generating price you'll see result page with prize and actions for it: get, reject or convert (only for money to loyalty)
5. Run send money command: `send-money/index N`, where __N__ is count of prizes, which should be sent at one time  


DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources


PLACES WHERE CHANGES WERE DONE
-------------------

      commands/           added SendMoneyController.php for sending money to user card
      controllers/        updated SiteController.php for needed actions for generating and managing prizes
      migrations/         see it to understand, which tables are used for generating prizes
      models/             add Prize and PrizeBoxes models for table description. Enum with types of prizes. User model was updated by adding columns `loyalty` and `money`
      runtime/            contains files generated during runtime
      tests/              see test unit/services/MoneyTypeTest.php
      services/           Main idea and business-logic of generating and managing is here
      views/              site/prize_view.php was added for manage prize


TESTING
-------

Tests are located in `tests` directory. They are developed with [Codeception PHP Testing Framework](http://codeception.com/).
By default there are 3 test suites:

- `unit`
- `functional`
- `acceptance`

Tests can be executed by running

```
vendor/bin/codecept run
```

or
```
vendor/bin/codecept run unit,functional 
```

The command above will execute unit and functional tests. Unit tests are testing the system components, while functional
tests are for testing user interaction. Acceptance tests are disabled by default as they require additional setup since
they perform testing in real browser. 

