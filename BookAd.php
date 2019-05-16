<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 11/13/2018
 * Time: 7:03 PM
 */

class BookAd extends Listing
{
    private $bookTitle = "";
    private $bookISBN = "";
    private $bookAuthor = "";
    private $courseName = "";
    private $courseNum;

    public function setBookTitle($title)
    {
        $this->bookTitle = $this->test_input($title);
    }

    public function getBookTitle()
    {
        return $this->bookTitle;
    }

    public function setBookISBN($isbn)
    {
        $this->bookISBN = $this->test_input($isbn);
    }

    public function getBookISBN()
    {
        return $this->bookISBN;
    }

    public function setBookAuthor($author)
    {
        $this->bookAuthor = $this->test_input($author);
    }

    public function getBookAuthor()
    {
        return $this->bookAuthor;
    }

    public function setBookCourseName($name)
    {
        $this->courseName = $this->test_input($name);
    }

    public function getBookCourseName()
    {
        return $this->courseName;
    }

    public function setBookCourseNum($num)
    {
        $this->courseNum = $this->test_input($num);
    }

    public function getBookCourseNum()
    {
        return $this->courseNum;
    }
}