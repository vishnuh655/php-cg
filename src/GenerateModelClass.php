<?php
namespace CodeGenerator;

// use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\PhpFile;

class GenerateModelClass
{
    private $className;

    private $classType;

    private $phpFile;

    private $outputPath = __DIR__;

    public function __construct($className)
    {
        $this->setClassName($className);
        $this->phpFile = new PhpFile();
        $this->setClassType($this->phpFile->addClass($className));
    }

    public function generateClass()
    {
        $this->classType
            ->setFinal()
            ->setExtends(ParentClass::class)
            ->addImplement(Countable::class)
            ->addTrait(Nette\SmartObject::class)
            ->addComment("Description of class.\nSecond line\n")
            ->addComment('@property-read Nette\Forms\Form $form');
        echo $this->classType;
    }

    public function writeToFile($outputPath)
    {

        $path = $outputPath . '/' . $this->className . ".php";
        if (!is_dir(dirname($path))) {
            if (mkdir(dirname($path), 0755, true) == false) {
                throw new \Exception(
                    "Failed to create directory at $path"
                );
            }
        }
        if (!file_put_contents($path, $this->phpFile)) {
            throw new \Exception("Failed to write to file");
        }
    }

    private function generatePhpFile($content){
        $file = new PhpFile();
        $file->addComment("This file is auto generated");
        $file->addClass($content);

    }

    function setClassName($className)
    {
        $this->className = $className;
    }

    function getClassName()
    {
        return $this->className;
    }

    function setClassType($classType)
    {
        $this->classType = $classType;
    }
    function getClassType()
    {
        return $this->classType;
    }
}
