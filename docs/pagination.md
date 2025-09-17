Paginate your entity results easily

Add the `EntityPaginationTrait` to your repository
```php
...
use \Rami\EntityKitBundle\Repository\Traits\EntityPaginationTrait;

class BlogRepository extends ServiceEntityRepository 
{
  use EntityPaginationTrait;
  
  ... 
  
  public function fetchLatestArticles(int $page = 1, int $numberPerPage = 15): array
  {
        $query = $this->createQueryBuilder('b')
            ... // query defintion
            .getQuery();
            
        return $this->paginateResult(query: $query, page: $page, nbPerPage: $numberPerPage);
  }
}

```
It returns an array with 
```php
[
    "total_items" => 5,
    "data" => [...]
    "current_page" => 1,
    "pages" => 1,
    "has_previous_page" => false,
    "has_next_page" => false,
    "items_per_page" => 15
]
```
and it can be made a json 
```json
{
	"total_items": 5,
	"data": [],
	"current_page": 1,
	"pages": 1,
	"has_previous_page": false,
	"has_next_page": false,
	"items_per_page": 15
}
```