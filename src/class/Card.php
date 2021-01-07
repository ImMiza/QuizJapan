<?php


class Card
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $question;

    /**
     * @var string
     */
    private $answer;

    /**
     * @var string[]
     */
    private $fake_answer;

    /**
     * Card constructor.
     * @param int $id
     * @param string $question
     * @param string $answer
     * @param string[] $fake_answer
     */
    public function __construct(int $id, string $question, string $answer, array $fake_answer)
    {
        $this->id = $id;
        $this->question = $question;
        $this->answer = $answer;
        $this->fake_answer = $fake_answer;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->question;
    }

    /**
     * @param string $question
     */
    public function setQuestion(string $question)
    {
        $this->question = $question;
    }

    /**
     * @return string
     */
    public function getAnswer(): string
    {
        return $this->answer;
    }

    /**
     * @param string $answer
     */
    public function setAnswer(string $answer)
    {
        $this->answer = $answer;
    }

    /**
     * @return string[]
     */
    public function getFakeAnswer(): array
    {
        return $this->fake_answer;
    }

    /**
     * @param string[] $fake_answer
     */
    public function setFakeAnswer(array $fake_answer)
    {
        $this->fake_answer = $fake_answer;
    }




}