<?php

/* webview/jobs/partials/job-item.twig */
class __TwigTemplate_1d35c34b4593619f1d74fc3bfba3eb26398b0891f3168a0947271fdf66abf902 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $context["title"] = $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "hire_title", array());
        // line 2
        $context["username"] = (($this->getAttribute((isset($context["job"]) ? $context["job"] : null), "webuser_fname", array()) . " ") . $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "webuser_lname", array()));
        // line 3
        echo "                
<div class=\"row margintop-2 ms_white_box ";
        // line 4
        echo twig_escape_filter($this->env, (isset($context["page"]) ? $context["page"] : null), "html", null, true);
        echo "\">
    <div class=\"col-md-12 freelancer-job white-box\" style=\"padding: 20px\">
        <div class=\"row\">
            
            ";
        // line 8
        echo twig_include($this->env, $context, "webview/jobs/partials/job-user-info.twig");
        echo "
            
            ";
        // line 10
        echo twig_include($this->env, $context, "webview/jobs/partials/job-payment-info.twig");
        echo "
            
            <div class=\"col-md-4\">
                <div class=\"row\">
                    ";
        // line 14
        if ((isset($context["freelancer"]) ? $context["freelancer"] : null)) {
            // line 15
            echo "                        ";
            if ((($this->getAttribute((isset($context["job"]) ? $context["job"] : null), "job_type", array()) == "fixed") || ((isset($context["page"]) ? $context["page"] : null) == "endedjobs"))) {
                // line 16
                echo "                            <div class=\"wj_massage_butt2\">
                        ";
            } else {
                // line 18
                echo "                            <div class=\"ms_hr_massage_butt\">
                        ";
            }
            // line 20
            echo "                    ";
        } else {
            // line 21
            echo "                    <div class=\"ms_hr_massage_butt\">
                    ";
        }
        // line 23
        echo "                        <div class=\"mystaff_msg_btnx hour_btn message_btn \">
                            <input type=\"button\" 
                                   class=\"btn btn-primary form-btn _job_btn_message\"
                                   data-bid=\"";
        // line 26
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "bid_id", array()), "html", null, true);
        echo "\"
                                   data-uid=\"";
        // line 27
        echo twig_escape_filter($this->env, (isset($context["chat_receiver_id"]) ? $context["chat_receiver_id"] : null), "html", null, true);
        echo "\"
                                   data-jid=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "job_id", array()), "html", null, true);
        echo "\"
                                   data-title=\"";
        // line 29
        echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
        echo "\"
                                   data-uname=\"";
        // line 30
        echo twig_escape_filter($this->env, (isset($context["username"]) ? $context["username"] : null), "html", null, true);
        echo "\"
                                   value=\"";
        // line 31
        echo twig_escape_filter($this->env, app_lang("text_job_btn_message"), "html", null, true);
        echo "\">
                        </div>
                    </div>
                    
                    ";
        // line 35
        if (array_key_exists("specific_btn_template", $context)) {
            echo "    
                        ";
            // line 36
            echo twig_include($this->env, $context, (isset($context["specific_btn_template"]) ? $context["specific_btn_template"] : null));
            echo "
                    ";
        }
        // line 38
        echo "                    
                    ";
        // line 39
        if (array_key_exists("options_dropdown", $context)) {
            // line 40
            echo "                    <div class=\"ms_hr_drop_butt\">
                        <div class=\"dropdown hour_btnx dropdown_btn\">
                            <button class=\"btn btn-default dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">
                                <span class=\"caret\"></span>
                            </button>
                            <ul style=\"left: -156px;\" class=\"dropdown-menu\">
                                ";
            // line 46
            echo twig_include($this->env, $context, (isset($context["options_dropdown"]) ? $context["options_dropdown"] : null));
            echo "
                            </ul>
                        </div>
                    </div>
                    ";
        }
        // line 51
        echo "                </div>
            </div> 
        </div>
        <div class=\"row\">
            <div class=\"job_detais col-md-12\">
                ";
        // line 57
        echo "                ";
        if (array_key_exists("profil_link", $context)) {
            // line 58
            echo "                 <a href=\"";
            echo twig_escape_filter($this->env, (isset($context["profil_link"]) ? $context["profil_link"] : null), "html", null, true);
            echo "\" 
                    style=\"font-size: 14px;color: #3DB0DD;\">";
            // line 59
            echo twig_escape_filter($this->env, app_lang("text_job_btn_op_view_profile"), "html", null, true);
            echo "
                 </a>
                 <strong>-</strong>
                ";
        }
        // line 63
        echo "                
                ";
        // line 65
        echo "                ";
        if (array_key_exists("job_detail_link", $context)) {
            // line 66
            echo "                <a href=\"";
            echo twig_escape_filter($this->env, (isset($context["job_detail_link"]) ? $context["job_detail_link"] : null), "html", null, true);
            echo "\">  ";
            echo twig_escape_filter($this->env, app_lang("text_job_link_detail"), "html", null, true);
            echo " </a>  
                <strong>-</strong>
                ";
        }
        // line 69
        echo "                
                ";
        // line 71
        echo "                <span><b>";
        echo twig_escape_filter($this->env, app_substr((isset($context["title"]) ? $context["title"] : null), twig_constant("LIST_JOB_TITLE_MAX"), "..."), "html", null, true);
        echo "</b></span>
            </div>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "webview/jobs/partials/job-item.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  167 => 71,  164 => 69,  155 => 66,  152 => 65,  149 => 63,  142 => 59,  137 => 58,  134 => 57,  127 => 51,  119 => 46,  111 => 40,  109 => 39,  106 => 38,  101 => 36,  97 => 35,  90 => 31,  86 => 30,  82 => 29,  78 => 28,  74 => 27,  70 => 26,  65 => 23,  61 => 21,  58 => 20,  54 => 18,  50 => 16,  47 => 15,  45 => 14,  38 => 10,  33 => 8,  26 => 4,  23 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% set title            = job.hire_title %}
{% set username         = job.webuser_fname ~ ' ' ~ job.webuser_lname %}
                
<div class=\"row margintop-2 ms_white_box {{ page }}\">
    <div class=\"col-md-12 freelancer-job white-box\" style=\"padding: 20px\">
        <div class=\"row\">
            
            {{ include('webview/jobs/partials/job-user-info.twig') }}
            
            {{ include('webview/jobs/partials/job-payment-info.twig') }}
            
            <div class=\"col-md-4\">
                <div class=\"row\">
                    {% if freelancer %}
                        {% if job.job_type == 'fixed' or page == 'endedjobs'  %}
                            <div class=\"wj_massage_butt2\">
                        {% else %}
                            <div class=\"ms_hr_massage_butt\">
                        {% endif %}
                    {% else %}
                    <div class=\"ms_hr_massage_butt\">
                    {% endif %}
                        <div class=\"mystaff_msg_btnx hour_btn message_btn \">
                            <input type=\"button\" 
                                   class=\"btn btn-primary form-btn _job_btn_message\"
                                   data-bid=\"{{ job.bid_id }}\"
                                   data-uid=\"{{ chat_receiver_id }}\"
                                   data-jid=\"{{ job.job_id }}\"
                                   data-title=\"{{ title }}\"
                                   data-uname=\"{{ username }}\"
                                   value=\"{{ app_lang('text_job_btn_message') }}\">
                        </div>
                    </div>
                    
                    {% if specific_btn_template is defined %}    
                        {{ include( specific_btn_template ) }}
                    {% endif %}
                    
                    {% if options_dropdown is defined %}
                    <div class=\"ms_hr_drop_butt\">
                        <div class=\"dropdown hour_btnx dropdown_btn\">
                            <button class=\"btn btn-default dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">
                                <span class=\"caret\"></span>
                            </button>
                            <ul style=\"left: -156px;\" class=\"dropdown-menu\">
                                {{ include( options_dropdown ) }}
                            </ul>
                        </div>
                    </div>
                    {% endif %}
                </div>
            </div> 
        </div>
        <div class=\"row\">
            <div class=\"job_detais col-md-12\">
                {# profile link #}
                {% if profil_link is defined %}
                 <a href=\"{{ profil_link }}\" 
                    style=\"font-size: 14px;color: #3DB0DD;\">{{ app_lang('text_job_btn_op_view_profile') }}
                 </a>
                 <strong>-</strong>
                {% endif %}
                
                {# job detail link #}
                {% if job_detail_link is defined %}
                <a href=\"{{ job_detail_link }}\">  {{ app_lang('text_job_link_detail') }} </a>  
                <strong>-</strong>
                {% endif %}
                
                {# job hire title #}
                <span><b>{{ app_substr(title, constant('LIST_JOB_TITLE_MAX'), '...' ) }}</b></span>
            </div>
        </div>
    </div>
</div>", "webview/jobs/partials/job-item.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\jobs\\partials\\job-item.twig");
    }
}
