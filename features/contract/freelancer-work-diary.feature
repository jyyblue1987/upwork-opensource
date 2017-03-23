Feaure: User provide work time for hourly contract
As a freelancer
I need to provide my work time on a week for an hourly contract
So that I can get payment.


    Background:
        Given that I'm connected with a freelancer account "Arun"
        And I have an hourly contract "New Job" identified by the code "Mkt2" with a employer "John"
        And this contract has been signed on "02-02-2017"
        And this contract is not ended
        And I'm on the full detail page contract "http://localhost/winjob/jobs/contracts/fmJob=Mkt2"

    Scenario: provide the first time of the current day for work diary
        Given that I'm on the contract page "http://localhost/winjob/jobs/contracts/fmJob=Mkt2"
        When I click on the "work diary" button
        Then I should see the title "New Job" of the job of my contract
        Then contract "New Job" with code "Mkt2" should be selected on the list of hourly contracts
        Then I should see the "Today's time: 0" and "Total" 
 
        