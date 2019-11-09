<?php

namespace Tests\Unit\Http\Requests;

use Faker\Factory;
use Tests\TestCase;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\ParticipantRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipantRequestTest extends TestCase
{
    use RefreshDatabase;

    /** @var \App\Http\Requests\ParticipantRequest */
    private $rules;

    /** @var \Illuminate\Validation\Validator */
    private $validator;

    /** @inheritDoc */
    protected function setUp(): void
    {
        parent::setUp();

        $this->validator = app()->get('validator');

        $this->rules = (new ParticipantRequest())->rules();
    }

    /**
     * Data Provider
     *
     * @return array|Iterable
     */
    public function validationProvider()
    {
        $faker = Factory::create();

        $data = [
            'last_name' => $faker->lastName,
            'first_name' => $faker->firstName,
            'mi' => $faker->randomLetter,
            'sex' => $faker->randomElement(['M', 'F']),
            'mobile' => ['99999999999'],
        ];

        return [
            'request_should_fail_when_no_last_name_is_provided' => [
                'passed' => false,
                'addToEvent' => false,
                'data' => Arr::except($data, 'last_name')
            ],
            'request_should_fail_when_no_first_name_is_provided' => [
                'passed' => false,
                'addToEvent' => false,
                'data' => Arr::except($data, 'first_name')
            ],
            'request_should_fail_when_no_mi_is_provided' => [
                'passed' => false,
                'addToEvent' => false,
                'data' => Arr::except($data, 'mi')
            ],
            'request_should_fail_when_no_sex_is_provided' => [
                'passed' => false,
                'addToEvent' => false,
                'data' => Arr::except($data, 'sex')
            ],
            'request_should_fail_when_sex_is_not_valid' => [
                'passed' => false,
                'addToEvent' => false,
                'data' => array_merge(Arr::except($data, 'sex'), ['sex' => 'O'])
            ],
            // 'request_should_fail_when_mobile_is_not_provided' => [
            //     'passed' => false,
            //     // 'data' => Arr::except($data, 'mobile.*')
            //     'data' => array_merge(Arr::except($data, 'mobile'), ['mobile' => []])
            // ],
            'request_should_fail_when_mobile_is_less_than_11_digits' => [
                'passed' => false,
                'addToEvent' => false,
                'data' => array_merge(Arr::except($data, 'mobile'), ['mobile' => ['1234567890']])
            ],
            'request_should_fail_when_mobile_is_not_numeric' => [
                'passed' => false,
                'addToEvent' => false,
                'data' => array_merge(Arr::except($data, 'mobile'), ['mobile' => ['123456789a']])
            ],
            'request_should_fail_when_email_is_not_valid' => [
                'passed' => false,
                'addToEvent' => false,
                'data' => array_merge($data, ['email' => ['invalid']])
            ],
            'request_should_pass_when_data_is_provided' => [
                'passed' => true,
                'addToEvent' => false,
                'data' => $data
            ],
            'request_should_fail_when_participant_role_is_not_provided_if_add_to_event_is_true' => [
                'passed' => false,
                'addToEvent' => true,
                'data' => $data
            ],
            'request_should_pass_when_data_with_participant_role_is_provided_if_add_to_event_is_true' => [
                'passed' => true,
                'addToEvent' => true,
                'data' => array_merge($data, ['participant_role_id' => 1])
            ],
        ];
    }

    /**
     * @dataProvider validationProvider
     *
     * @param bool $shouldPass
     * @param bool $addToEvent
     * @param array $mockedRequestData
     * @return void
     */
    public function testValidationResultsAsExpected(bool $shouldPass, bool $addToEvent, array $mockedRequestData)
    {
        Route::shouldReceive('is')->once()->andReturn($addToEvent);
        $this->assertEquals($shouldPass, $this->validate($mockedRequestData));
    }

    /**
     * Validate the request
     *
     * @param array $mockedRequestData
     * @return bool
     */
    protected function validate($mockedRequestData)
    {
        return $this->validator->make($mockedRequestData, $this->rules)->passes();
    }
}
