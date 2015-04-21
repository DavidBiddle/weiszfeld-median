# weiszfeld-median
## PHP implementation of Weiszfeld algorithm
This function allows you to get the geometric median of:
* an arbitrary number of points 
* in an arbitrary number of dimensions
* over an arbitrary number of iterations
* to an arbitrary number of decimal places

## Usage
To use it you'll need to have your data in the form of an array of points with each set of points represented by an array of coordinates (in however many dimensions you're using).
```php
$dataArray = [
  [ 'x' => 1, 'y' => 2, 'z' => 3 ],
  [ 'x' => 9, 'y' => 5, 'z' => 299792458 ],
  [ 'x' => 50, 'y' => 3.14, 'z' => 3 ]
]
```
and then call `getMedian()` on it:

```php
$median = getMedian($dataArray,$iterations,$decimalPlaces);
```
where `$iterations` and `$decimalPlaces` are the respective numbers of iterations and decimal places you want.

You'll get your answer as an array of coordinates.
