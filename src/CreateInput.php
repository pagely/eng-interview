<?php


namespace Pagely\Interview;

use Equip\Data\EntityInterface;
use Equip\Data\Traits\EntityTrait;

/**
 * @Input\Request(
 *     title="Create a new account",
 *     path="/accounts",
 *     method="POST",
 *     contentType="application/json",
 *     bodyParameters={
 *         @Input\Parameter(
 *             name="firstName",
 *             description="Account user's first name",
 *             required=true,
 *             type="string",
 *             sample="Sandy",
 *             validators={
 *                 @Input\Validation(type="StringType"),
 *                 @Input\Validation(type="Length", options={2, 200}),
 *             }
 *         ),
 *         @Input\Parameter(
 *             name="lastName",
 *             description="Account user's last name",
 *             required=true,
 *             type="string",
 *             sample="McTester",
 *             validators={
 *                 @Input\Validation(type="StringType"),
 *                 @Input\Validation(type="Length", options={2, 200}),
 *             }
 *         ),
 *         @Input\Parameter(
 *             name="companyName",
 *             description="Company name",
 *             required=true,
 *             type="string",
 *             sample="BobCo",
 *             validators={
 *                 @Input\Validation(type="StringType"),
 *                 @Input\Validation(type="Length", options={2, 200}),
 *             }
 *         ),
 *         @Input\Parameter(
 *             name="password",
 *             description="Account password - Only changeable by account owner",
 *             required=true,
 *             type="string",
 *             sample="H#U$J@NJnv9234",
 *             validators={
 *                 @Input\Validation(type="StringType"),
 *                 @Input\Validation(type="Length", options={8, 200}),
 *                 @Input\Validation(type=PasswordBlacklistRule::class),
 *             }
 *         ),
 *         @Input\Parameter(
 *             name="authAnswer",
 *             description="PIN",
 *             required=false,
 *             type="string",
 *             sample=9982,
 *             validators={
 *                 @Input\Validation(type="Numeric"),
 *                 @Input\Validation(type="Length", options={4, 200}),
 *             }
 *         ),
 *         @Input\Parameter(
 *             name="email",
 *             description="Account email",
 *             required=true,
 *             type="string",
 *             sample="foo@bar.baz",
 *             validators={
 *                 @Input\Validation(type="NotEmpty"),
 *                 @Input\Validation(type="Email"),
 *                 @Input\Validation(type=AccountNotExistsByEmail::class),
 *                 @Input\Validation(type=AccountNotExistsByUsername::class),
 *             }
 *         ),
 *         @Input\Parameter(
 *             name="phone",
 *             description="Mobile phone (for alerts, etc)",
 *             required=false,
 *             type="string",
 *             sample="111 222 3333",
 *             validators={
 *                 @Input\Validation(type="StringType"),
 *                 @Input\Validation(type="Length", options={1, 40}),
 *             }
 *         ),
 *         @Input\Parameter(
 *             name="twitter",
 *             description="Twitter handle",
 *             required=false,
 *             type="string",
 *             sample="alphabet",
 *             validators={
 *                 @Input\Validation(type="StringType"),
 *                 @Input\Validation(type="Length", options={1, 200}),
 *                 @Input\Validation(type="NoWhitespace")
 *             }
 *         ),
 *         @Input\Parameter(
 *             name="billingPlanId",
 *             description="Billing Plan ID",
 *             required=true,
 *             type="string",
 *             sample="1037yy",
 *             validators={
 *                 @Input\Validation(type="StringType"),
 *                 @Input\Validation(type="NotEmpty"),
 *                 @Input\Validation(type="NoWhitespace"),
 *             }
 *         ),
 *         @Input\Parameter(
 *             name="region",
 *             description="AWS Region",
 *             required=true,
 *             type="string",
 *             sample="us-east-1",
 *             validators={
 *                 @Input\Validation(type=OneOfEnum::class, options=AwsRegion::class),
 *             }
 *         ),
 *         @Input\Parameter(
 *             name="billingSource",
 *             description="Billing source (ie manual, paypal, or invoice)",
 *             required=false,
 *             type="string",
 *             sample="paypal",
 *             validators={
 *                 @Input\Validation(type="StringType"),
 *                 @Input\Validation(type="NoWhitespace"),
 *             }
 *         ),
 *         @Input\Parameter(
 *             name="billingToken",
 *             description="Recurly Token",
 *             required=false,
 *             type="string",
 *             sample="SOMERANDOMSTRING",
 *             validators={
 *                 @Input\Validation(type="StringType"),
 *                 @Input\Validation(type="NoWhitespace"),
 *             }
 *         ),
 *         @Input\Parameter(
 *             name="addons",
 *             description="Array of: addon IDs or objects containing id and quantity",
 *             required=true,
 *             type="string[]",
 *             sample={},
 *             validators={
 *                 @Input\Validation(type="ArrayType"),
 *             },
 *             parameter=@Input\Parameter(
 *                 type="string",
 *                 sample="37",
 *                 validators={
 *                   @Input\Validation(type="NotEmpty"),
 *                 }
 *             ),
 *         ),
 *         @Input\Parameter(
 *             name="vat",
 *             description="VAT (for EU customers)",
 *             required=false,
 *             type="string",
 *             sample="VAT ID",
 *             validators={
 *                 @Input\Validation(type="StringType"),
 *                 @Input\Validation(type="NoWhitespace"),
 *             }
 *         ),
 *         @Input\Parameter(
 *             name="supportId",
 *             description="External support (ie Zendesk) ID",
 *             required=false,
 *             type="string",
 *             sample="1234567890fds",
 *             validators={
 *                 @Input\Validation(type="StringType"),
 *                 @Input\Validation(type="Length", options={1, 120}),
 *                 @Input\Validation(type="NoWhitespace")
 *             },
 *         ),
 *         @Input\Parameter(
 *             name="awsCustomerId",
 *             description="AWS Customer ID",
 *             required=false,
 *             type="string",
 *             sample="43546hytebgveth64u7",
 *             validators={
 *                 @Input\Validation(type="StringType"),
 *                 @Input\Validation(type="NoWhitespace"),
 *             }
 *         ),
 *         @Input\Parameter(
 *             name="acceptTos",
 *             description="Bool confirming acceptance of current TOS",
 *             required=false,
 *             type="bool",
 *             sample=true,
 *             validators={
 *                 @Input\Validation(type="BoolType"),
 *             }
 *         ),
 *         @Input\Parameter(
 *             name="address1",
 *             description="Address line 1",
 *             required=true,
 *             type="string",
 *             sample="123 Main St",
 *             validators={
 *                 @Input\Validation(type="StringType"),
 *                 @Input\Validation(type="Length", options={2, 250}),
 *             }
 *         ),
 *         @Input\Parameter(
 *             name="address2",
 *             description="Address line 2",
 *             required=false,
 *             type="string",
 *             sample="123 Main St",
 *             validators={
 *                 @Input\Validation(type="StringType"),
 *                 @Input\Validation(type="Length", options={0, 250}),
 *             }
 *         ),
 *         @Input\Parameter(
 *             name="city",
 *             description="City",
 *             required=false,
 *             type="string",
 *             sample="Phoenix",
 *             validators={
 *                 @Input\Validation(type="StringType"),
 *                 @Input\Validation(type="Length", options={0, 250}),
 *             }
 *         ),
 *         @Input\Parameter(
 *             name="state",
 *             description="State",
 *             required=true,
 *             type="string",
 *             sample="AZ",
 *             validators={
 *                 @Input\Validation(type="StringType"),
 *                 @Input\Validation(type="Length", options={1, 250}),
 *             }
 *         ),
 *         @Input\Parameter(
 *             name="zip",
 *             description="Zipcode or postal code",
 *             required=true,
 *             type="string",
 *             sample="123456",
 *             validators={
 *                 @Input\Validation(type="StringType"),
 *                 @Input\Validation(type="Length", options={1, 50}),
 *             }
 *         ),
 *         @Input\Parameter(
 *             name="quoteUuid",
 *             description="Quote UUID if account was created based on a quote",
 *             required=false,
 *             type="string",
 *             sample="945c6664-d7fc-4a8c-bd24-05af0cc9f2c4",
 *             validators={
 *                 @Input\Validation(type="StringType"),
 *                 @Input\Validation(type="NoWhitespace"),
 *             }
 *         ),
 *     }
 * )
 * @Input\Responses({
 *      @Input\Response(
 *          contentType="application/json",
 *          description="Success",
 *          statusCode=201
 *      ),
 *      @Input\Response(
 *          contentType="application/json",
 *          description="Validation Errors",
 *          statusCode=422,
 *          body={
 *              @Input\Parameter(
 *                  name="errors",
 *                  type="array"
 *              )
 *          }
 *      )
 * })
 * @codeCoverageIgnore
 */
class CreateInput implements EntityInterface
{
    use EntityTrait;
    use NoAuthCheckTrait;

    private $firstName;
    private $lastName;
    private $companyName;
    private $password;
    private $authQuestion = 'PIN';
    private $authAnswer;
    private $email;
    private $phone;
    private $twitter;
    private $billingPlanId;
    private $billingSource = 'invoice';
    private $billingToken;
    private $region;
    private $addons = [];
    private $vat;
    private $supportId;
    private $awsCustomerId;
    private $acceptTos = false;
    private $address1;
    private $address2;
    private $city;
    private $state;
    private $zip;
    private $quoteUuid;

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return mixed
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * @return mixed
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getAuthQuestion()
    {
        return $this->authQuestion;
    }

    /**
     * @return mixed
     */
    public function getAuthAnswer()
    {
        return $this->authAnswer;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @return mixed
     */
    public function getBillingToken()
    {
        return $this->billingToken;
    }

    /**
     * @return mixed
     */
    public function getBillingPlanId()
    {
        return $this->billingPlanId;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return array
     */
    public function getAddons(): array
    {
        return $this->addons;
    }

    /**
     * @return mixed
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * @return bool
     */
    public function getAcceptTos(): bool
    {
        return $this->acceptTos;
    }

    /**
     * @return mixed
     */
    public function getSupportId()
    {
        return $this->supportId;
    }

    /**
     * @return mixed
     */
    public function getAwsCustomerId()
    {
        return $this->awsCustomerId;
    }

    /**
     * @return mixed
     */
    public function getBillingSource()
    {
        return $this->billingSource;
    }

    /**
     * @return mixed
     */
    public function getQuoteUuid()
    {
        return $this->quoteUuid;
    }

    /**
     * @return mixed
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * @return mixed
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return mixed
     */
    public function getZip()
    {
        return $this->zip;
    }
}
