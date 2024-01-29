Задача: 
Написать построитель запросов (Active Query) для MDX 
Тестовый файл - test.php сравнивает результат работы построителя

```shell
docker-compose up -d

docker exec -it php-mdx sh

#in container: 
/bin/sh composer install
/bin/sh php test.php
```

```shell
WITH SET MySetName AS {[Measures].[Amount], [Measures].[Rest]}
SELECT
    NONEMPTY([Address].[Town] * NONEMPTY([Branch].[Name] * NONEMPTY([SaleType].[Name], MySetName), MySetName), MySetName) * MySetName ON COLUMNS,
    NONEMPTY([Product].[Product].[Name] * NONEMPTY([Date].[Date].[Day], MySetName), MySetName) ON ROWS
FROM (
    SELECT 
        {
          [Product].[Product].&[134947954], 
          [Product].[Product].&[134947981], 
          [Product].[Product].&[11145970], 
          [Product].[Product].&[101362503]
        } * {
          [Address].[Region].&[77], 
          [Address].[Region].&[54]
        } * {
          [Branch].[Name].&[6332], 
          [Branch].[Name].&[295]
        } ON COLUMNS
    FROM (
        SELECT
            {[Date].[Date].[Month].&[202101]:[Date].[Date].[Month].&[202112]} ON COLUMNS
        FROM [Sales]
    )
)
```

