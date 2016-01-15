<?php

namespace Galmi\XacmlBundle\Tests\Xacml;


use Galmi\Xacml\Request;
use Galmi\XacmlBundle\Tests\Xacml\Entity\Student;
use Galmi\XacmlBundle\Xacml\PolicyInformationPoint;
use Galmi\XacmlBundle\Xacml\Resource;

class PolicyInformationPointTest extends \PHPUnit_Framework_TestCase
{

    public function testGetGetter()
    {
        $entityManager = $this
            ->getMockBuilder('Doctrine\ORM\EntityManager')
            ->setMethods(array('getRepository'))
            ->disableOriginalConstructor()
            ->getMock();
        $pip = new PolicyInformationPoint($entityManager);
        $getGetter = self::getMethod('getGetter');
        $this->assertEquals('getId', $getGetter->invokeArgs($pip, ['id']));
    }

    /**
     * Test empty identifier
     *
     * @expectedException \Exception
     * @expectedExceptionMessage Empty identifier of repository Entity
     */
    public function testGetEntity()
    {
        $entityManager = $this
            ->getMockBuilder('Doctrine\ORM\EntityManager')
            ->setMethods(array('getRepository'))
            ->disableOriginalConstructor()
            ->getMock();
        $pip = new PolicyInformationPoint($entityManager);
        $getGetter = self::getMethod('getEntity');
        $resource = new Resource('Entity', null);
        $getGetter->invokeArgs($pip, [$resource]);
    }

    /**
     * Test entity not found
     *
     * @expectedException \Exception
     * @expectedExceptionMessage Repository for Entity not found
     */
    public function testGetEntity2()
    {
        $entityManager = $this
            ->getMockBuilder('Doctrine\ORM\EntityManager')
            ->setMethods(array('getRepository'))
            ->disableOriginalConstructor()
            ->getMock();
        $entityManager->method('getRepository')->willReturn(null);
        $pip = new PolicyInformationPoint($entityManager);
        $getGetter = self::getMethod('getEntity');
        $resource = new Resource('Entity', 3);
        $getGetter->invokeArgs($pip, [$resource]);
    }

    /**
     * Test return entity object
     */
    public function testGetEntity3()
    {
        /**
         * Infering that the the Subject Under Test is dealing with a single
         * repository.
         *
         * @var \Doctrine\ORM\EntityRepository
         */
        $repository = $this
            ->getMockBuilder('Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->setMethods(array('find'))
            ->getMock();

        $repository
            ->expects($this->once())
            ->method('find')
            ->will($this->returnValue(new \stdClass()));

        $entityManager = $this
            ->getMockBuilder('Doctrine\ORM\EntityManager')
            ->setMethods(array('getRepository'))
            ->disableOriginalConstructor()
            ->getMock();
        $entityManager->method('getRepository')->willReturn($repository);
        $pip = new PolicyInformationPoint($entityManager);
        $getGetter = self::getMethod('getEntity');
        $resource = new Resource('Entity', 3);
        $this->assertInstanceOf('\stdClass', $getGetter->invokeArgs($pip, [$resource]));
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Entity Student with identifier 3 not found
     */
    public function testGetEntity4()
    {
        /**
         * Infering that the the Subject Under Test is dealing with a single
         * repository.
         *
         * @var \Doctrine\ORM\EntityRepository
         */
        $repository = $this
            ->getMockBuilder('Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->setMethods(array('find'))
            ->getMock();

        $repository
            ->expects($this->once())
            ->method('find')
            ->will($this->returnValue(null));

        $entityManager = $this
            ->getMockBuilder('Doctrine\ORM\EntityManager')
            ->setMethods(array('getRepository'))
            ->disableOriginalConstructor()
            ->getMock();
        $entityManager->method('getRepository')->willReturn($repository);
        $pip = new PolicyInformationPoint($entityManager);
        $getGetter = self::getMethod('getEntity');
        $resource = new Resource('Student', 3);
        $getGetter->invokeArgs($pip, [$resource]);
    }

    public function testGetValue1()
    {
        $xacmlRequest = new Request([
            'Environment' => [
                'time' => '12:00'
            ]
        ]);

        $entityManager = $this
            ->getMockBuilder('Doctrine\ORM\EntityManager')
            ->setMethods(array('getRepository'))
            ->disableOriginalConstructor()
            ->getMock();
        $entityManager->method('getRepository')->willReturn(null);
        $pip = new PolicyInformationPoint($entityManager);

        $this->assertEquals('12:00', $pip->getValue($xacmlRequest, 'Environment.time'));
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Attribute Environment.date not found
     */
    public function testGetValue2()
    {
        $xacmlRequest = new Request([
            'Environment' => [
                'time' => '12:00'
            ]
        ]);

        $entityManager = $this
            ->getMockBuilder('Doctrine\ORM\EntityManager')
            ->setMethods(array('getRepository'))
            ->disableOriginalConstructor()
            ->getMock();
        $entityManager->method('getRepository')->willReturn(null);
        $pip = new PolicyInformationPoint($entityManager);

        echo $pip->getValue($xacmlRequest, 'Environment.date');
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Attribute Environment.date not found
     */
    public function testGetValue3()
    {
        $xacmlRequest = new Request();

        $entityManager = $this
            ->getMockBuilder('Doctrine\ORM\EntityManager')
            ->setMethods(array('getRepository'))
            ->disableOriginalConstructor()
            ->getMock();
        $entityManager->method('getRepository')->willReturn(null);
        $pip = new PolicyInformationPoint($entityManager);

        echo $pip->getValue($xacmlRequest, 'Environment.date');
    }

    public function testGetValue4()
    {
        $resource = new Resource('Test\Student', 1);
        $xacmlRequest = new Request([
            'Resource' => [
                'Student' => $resource
            ]
        ]);

        $repository = $this
            ->getMockBuilder('Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->setMethods(array('find'))
            ->getMock();

        $repository
            ->expects($this->once())
            ->method('find')
            ->will($this->returnValue(new Student('Peter')));

        $entityManager = $this
            ->getMockBuilder('Doctrine\ORM\EntityManager')
            ->setMethods(array('getRepository'))
            ->disableOriginalConstructor()
            ->getMock();
        $entityManager->method('getRepository')->willReturn($repository);
        $pip = new PolicyInformationPoint($entityManager);

        $this->assertEquals('Peter', $pip->getValue($xacmlRequest, 'Student.name'));
    }

    protected static function getMethod($name)
    {
        $class = new \ReflectionClass('Galmi\XacmlBundle\Xacml\PolicyInformationPoint');
        $method = $class->getMethod($name);
        $method->setAccessible(true);

        return $method;
    }
}
