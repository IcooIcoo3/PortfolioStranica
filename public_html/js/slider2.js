/**
 * Created by Mario on 17.06.14..
 */

( function() {

    var SliderException = {
        type : null,
        message : null,
        fix : null,
        object : null,
        explain: function() {
            console.log('Type: ' + this.type);
            console.log('Message: ' + this.message);
            console.log('Fix: ' + this.fix);
            console.log('Thrown in: ' + this.object);
        }
    };

    function Position() {
        $('#mario-slider figure').each(function(index) {
            $(this).attr('style', 'z-index:' + (1000 - index));
        });

        this.setPosition = function(positionObj) {
            var imageObject = positionObj.object;
            imageObject.css({
                top: positionObj.top,
                left: positionObj.left,
                opacity: positionObj.opacity
            })
        };
    }

    function Animator(position) {
        this.goShow = function(projectInfo, current, next) {
            var loading = Animator.loading,
                pageLink = Animator.pageLink,
                main = Animator.main;

            loading.fadeIn();
            var figureCurrent = main.find('figure')[current];
            var figureNext = main.find('figure')[next];

            pageLink.fadeOut();
            pageLink.promise().done(function() {
                pageLink.attr('href', 'http://' + $(figureNext).data('mario-slider'));
                pageLink.text($(figureNext).data('mario-slider'));
            });

            var width = $(figureCurrent).width();

            $('.project-info').animate({
                opacity: 0
            }, 400, function() {
                projectInfo.remove().add(next, true);

                $(figureCurrent).animate({
                    opacity: 0,
                    left: (width + 100) + 'px'
                }, 1000, function () {
                    position.setPosition({
                        top: -($(this).height() + 50) + 'px',
                        left: '0px',
                        object: $(this)
                    });
                });

                $(figureNext).animate({
                    opacity: 1,
                    top: '0px'
                }, 1000, function () {
                    pageLink.fadeIn();
                    $('.project-info').animate({
                        opacity: 1
                    }, 400, function() {
                        loading.fadeOut();
                    })
                });

            });
        };
    }

    function ProjectInfo() {
        var query = window.location.pathname.split('/'),
            validated = false,
            dataObject,
            infoElements;

        var locale = function() {
            if(query.indexOf('hr') != -1) {
                return 'hr';
            } else if(query.indexOf('en')) {
                return 'en';
            } else if(query.indexOf('de')) {
                return 'de';
            }

            return false;
        }();


        this.query = function() {
            if( false !== locale) {
                var url = '/icooicoo/PortfolioStranica/public_html/app_dev.php/' + locale + '/projects';
                $.ajax(url, {
                    accepts: 'application/json',
                    async: false,
                    dataType: 'json'
                }).done(function(data, textStatus, jqXHR) {
                        if(jqXHR.status == 200) {
                            dataObject = data;
                        }
                    });

                return this;
            }

            return this;
        };

        this.add = function(index, show) {
            var infoWrap = $('#project-info-id'),
                elements = {},
                counter = 0,
                data = dataObject[index],
                display = (show) ? 'block' : 'none';

            elements[counter++] = $("<h1></h1>")
                                .text(data.naslov)
                                .css({
                                    display: display
                                });

            $.each(data.lines, function(index, value) {
                elements[counter++] = $("<label></label>")
                    .addClass('col-xs-12')
                    .text(value)
                    .css({
                        display: display
                    })
            });

            for(var prop in elements) {
                if(elements.hasOwnProperty(prop)) {
                    infoWrap.append(elements[prop]);
                }
            }

            infoElements = elements;
            return this;
        };

        this.remove = function() {
            var parent;
            $('#project-info-id').find('*').each(function() {
                parent = $(this).parent().get(0);
                parent.removeChild(this);
            });

            return this;
        };
    }

    function MarioSlider(position) {
        var counter = function(length) {
            var counter = 0,
                total = length - 1;

            return function(direction) {
                if(direction === MarioSlider.NEXT) {
                    if(counter == total) {
                        counter = 0;
                        return counter;
                    }

                    counter = counter + 1;
                    return counter;
                }
                else if(direction === MarioSlider.PREVIOUS) {
                    if(counter == 0) {
                        counter = total;
                        return counter;
                    }

                    counter = counter - 1;
                    return counter;
                }
                else if(direction === MarioSlider.CURRENT) {
                    return counter;
                }

                return false;
            }
        };

        var animator = new Animator(position);
        var projectInfo = new ProjectInfo();

        var main = $('#mario-slider'),
            imgs = main.find('figure img'),
            pageLink = $('#stranica-link-id'),
            loading = $('#loading-id'),
            callback = counter(imgs.length);

        Animator.pageLink = pageLink;
        Animator.loading = loading;
        Animator.main = main;

        var first = main.find('figure:first-child');
        pageLink.attr('href', 'http://' + first.data('mario-slider'));
        pageLink.text(first.data('mario-slider'));
        pageLink.show();

        // prvi treba biti isti kao i bilo koji klik

        projectInfo.query().add(0, true);

        imgs.each(function(index) {
            $(this).load(function() {
                var height = $(this).parent().height();
                if(index == 0) {
                    position.setPosition({
                        top: '0px',
                        left: '0px',
                        object : $(this).parent(),
                        opacity: 1
                    });
                }
                else {
                    position.setPosition({
                        top: - (height + 50) + 'px',
                        left: '0px',
                        object: $(this).parent(),
                        opacity: 0
                    })
                }
            })
        });

        this.nextSlide = function() {
            var current = callback(MarioSlider.CURRENT);
            var next = callback(MarioSlider.NEXT);
            animator.goShow(projectInfo, current, next);
        };

        this.previousSlide = function() {
            var current = callback(MarioSlider.CURRENT);
            var previous = callback(MarioSlider.PREVIOUS);
            animator.goShow(projectInfo, current, previous);
        };
    }

    $(document).ready(function() {
        MarioSlider.CURRENT = 8;
        MarioSlider.NEXT = 16;
        MarioSlider.PREVIOUS = 32;

        var slider = new MarioSlider(new Position());

        $('#right-id').click(function(evn) {
            evn.preventDefault();
            slider.nextSlide();

        });

        $('#left-id').click(function(evn) {
            evn.preventDefault();
            slider.previousSlide();
        })
    })
} () );
