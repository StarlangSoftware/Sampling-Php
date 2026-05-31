Sampling Strategies
============

## K-Fold cross-validation
In K-fold cross-validation, the aim is to generate K training/validation set pair, where training and validation sets on fold i do no overlap. First, we divide the dataset X into K parts as X<sub>1</sub>; X<sub>2</sub>; ... ; X<sub>K</sub>. Then for each fold i, we use X<sub>i</sub> as the validation set and the remaining as the training set.

Possible values of K are 10 or 30. One extreme case of K-fold cross-validation is leave-one-out, where K = N and each validation set has only one instance.
If we have more computation power, we can have multiple runs of K-fold cross-validation, such as 10 x 10 cross-validation or 5 x 2 cross-validation.

## Bootstrapping

If we have very small datasets, we do not insist on the non-overlap of training and validation sets. In bootstrapping, we generate K multiple training sets, where each training set contains N examples (like the original dataset). To get N examples, we draw examples with replacement. For the validation set, we use the original dataset. The drawback of bootstrapping is that the bootstrap samples overlap more than the cross-validation sample, hence they are more dependent.

Video Lectures
============

[<img src="https://github.com/StarlangSoftware/Sampling/blob/master/video.jpg" width="50%">](https://youtu.be/wijWOiv70nE)

For Developers
============

You can also see [Java](https://github.com/starlangsoftware/Sampling), [Python](https://github.com/starlangsoftware/Sampling-Py), [Cython](https://github.com/starlangsoftware/Sampling-Cy), [Js](https://github.com/starlangsoftware/Sampling-Js), [C#](https://github.com/starlangsoftware/Sampling-CS), [Swift](https://github.com/starlangsoftware/Sampling-Swift), or [C++](https://github.com/starlangsoftware/Sampling-CPP) repository.

## Requirements

* [Php 8.4 or higher](#php)
* [Git](#git)

### Php 

To check if you have a compatible version of Php installed, use the following command:

    php -V
    
You can find the latest version of Php [here](https://www.php.net/downloads/).

### Git

Install the [latest version of Git](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git).

## Download Code

In order to work on code, create a fork from GitHub page. 
Use Git for cloning the code to your local or below line for Ubuntu:

	git clone <your-fork-git-link>

A directory called Sampling will be created. Or you can use below link for exploring the code:

	git clone https://github.com/starlangsoftware/Sampling-Php.git

## Open project with PhpStorm IDE

Steps for opening the cloned project:

* Start IDE
* Select **File | Open** from main menu
* Choose `Sampling-Php` file
* Select open as project option
* Couple of seconds, dependencies will be downloaded.

For Contibutors
============

### composer.json file

1. autoload is important when this package will be imported.
```
  "autoload": {
    "psr-4": {
      "olcaytaner\\WordNet\\": "src/"
    }
  },
```
2. Dependencies should be maximum (not only direct but also indirect references should also be given), everything directly in the code should be given here.
```
  "require-dev": {
    "phpunit/phpunit": "11.4.0",
    "olcaytaner/dictionary": "1.0.0",
    "olcaytaner/xmlparser": "1.0.1",
    "olcaytaner/morphologicalanalysis": "1.0.0"
  }
```

### Data files
1. Add data files to the project folder. Subprojects should include all data files of the parent projects.

### Php files

1. Do not forget to comment each function.
```
    /**
     * Returns true if specified semantic relation type presents in the relations list.
     *
     * @param SemanticRelationType $relationType element whose presence in the list is to be tested
     * @return bool true if specified semantic relation type presents in the relations list
     */
    public function containsRelationType(SemanticRelationType $relationType): bool{
        foreach ($this->relations as $relation){
            if ($relation instanceof SematicRelation && $relation->getRelationType() == $relationType){
                return true;
            }
        }
        return false;
    }
```
2. Function names should follow caml case.
```
    public function getRelation(int $index): Relation{
```
3. Write getter and setter methods.
```
    public function getOrigin(): ?string
    public function setName(string $name): void
```
4. Use standard javascript test style by extending the TestCase class. Use setup when necessary.
```
class WordNetTest extends TestCase
{
    private WordNet $turkish;

    protected function setUp(): void
    {
        ini_set('memory_limit', '450M');
        $this->turkish = new WordNet();
    }

    public function testSize()
    {
        $this->assertEquals(78327, $this->turkish->size());
    }
```
5. Enumerated types should be declared with enum.
```
enum CategoryType
{
    case MATHEMATICS;
    case SPORT;
    case MUSIC;
    case SLANG;
    case BOTANIC;
```
6. If there are multiple constructors for a class, define them as constructor1, constructor2, ..., then from the original constructor call these methods.
```
    public function constructor1(string $path, string $fileName): void
    public function constructor2(string $path, string $extension, int $index): void
    public function __construct(string $path, string $extension, ?int $index = null)
```
7. Use __toString method if necessary to create strings from objects.
```
    public function __toString(): string
```
8. Use xmlparser package for parsing xml files.
```
  $doc = new XmlDocument("../test.xml");
  $doc->parse();
  $root = $doc->getFirstChild();
  $firstChild = $root->getFirstChild();
```
